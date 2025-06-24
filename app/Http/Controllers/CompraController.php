<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        // Cargar la relación con cliente para mostrar el nombre
        $compras = Compra::with('cliente') // Añadido with('cliente')
            ->select(
                'id',
                'cliente_id',
                'fecha',
                'medio_pago',
                'comentario',
                'estado'
            )
            ->where('estado', true)
            ->orderby('id', 'asc')
            ->get();

        $clientes = Cliente::where('estado', true)->get();

        return view('compras.index', compact(
            'compras',
            'clientes'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'medio_pago' => 'required|in:T,E,C', // Mantener consistencia con las vistas
            'comentario' => 'nullable|string|max:300'
        ]);

        $request->merge([
            'estado' => true,
            'id_usuario' => Auth::id(),
        ]);

        Compra::create($request->all());

        return redirect()->route('compras.index')->with('success', 'Compra creada exitosamente.');
    }

    public function show(Compra $compra)
    {
        // Cargar la relación con cliente para la respuesta JSON
        if ($compra->estado) {
            return response()->json([
                'id' => $compra->id,
                'cliente_id' => $compra->cliente_id,
                'fecha' => $compra->fecha,
                'medio_pago' => $compra->medio_pago,
                'comentario' => $compra->comentario,
                'cliente' => $compra->cliente // Añadido para relación
            ]);
        }

        return response()->json(
            ['message' => 'Compra no encontrada'],
            404
        );
    }

    public function update(Request $request, Compra $compra)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'medio_pago' => 'required|in:T,E,C', // Mantener consistencia con las vistas
            'comentario' => 'nullable|string|max:300',
            'estado' => 'required|boolean'
        ]);

        $request->merge(['id_usuario_actualizacion' => Auth::id()]);
        $compra->update($request->all());

        // Devolver también el nombre del cliente para actualizar la vista
        $cliente = Cliente::find($request->cliente_id);
        return response()->json([
            'message' => 'Compra actualizada correctamente',
            'cliente_nombre' => $cliente->nombre // Añadido para actualizar vista
        ]);
    }

    public function destroy(Compra $compra)
    {
        $compra->estado = false;
        $compra->save();

        return response()->json(['success' => true]);
    }

    // Nuevo método para obtener datos de compra para edición
    public function getCompraData($id)
    {
        $compra = Compra::with('cliente')->findOrFail($id);
        return response()->json($compra);
    }
}
