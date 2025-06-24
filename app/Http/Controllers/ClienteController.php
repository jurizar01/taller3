<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        //Segunda Forma
        $clientes = Cliente::select(
            'id',
            'dni',
            'nombre',
            'apellidos',
            'celular',
            'direccion',
            'correo_electronico',
            'estado'
        )

            ->where('estado', true)
            ->orderby('id', 'asc')
            ->get();





        return view('clientes.index', compact(
            'clientes',

        ));
    }



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->merge([
            'estado' => 1,
            'id_usuario' => Auth::id(),
        ]);


        //Crear el nuevo cliente
        Cliente::create([

            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'direccion' => $request->direccion,
            'correo_electronico' => $request->correo_electronico,
            'estado' => $request->estado,

        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $clienteFiltrado = Cliente::select(
            'id',
            'dni',
            'nombre',
            'apellidos',
            'celular',
            'direccion',
            'correo_electronico'
        )
            ->where('id', $cliente->id)
            ->where('estado',true)
            ->first();

        if ($clienteFiltrado) {
            return response()->json($clienteFiltrado);
        }

        return response()->json(
            ['message' => 'Cliente no encontrado'],
            404
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // ProductosController.php
    public function update(Request $request, Cliente $cliente)
{
    // Verificar autorización
    // if ($producto->id_usuario != auth()->id()) {
    //     return response()->json(['message' => 'No autorizado'], 403);
    // }

    // Validación
    $request->validate([
        'dni' => 'required|string|max:20',
        'nombre' => 'required|string|max:40',
        'apellidos' => 'required|string|max:100',
        'celular' => 'required|numeric|min:0',
        'direccion' => 'required|string|max:80',
        'correo_electronico' => 'required|string|max:70',
    ]);

    // Actualización directa (asumiendo $fillable configurado)
    $cliente->update($request->all());

    return response()->json(['message' => 'Cliente actualizado correctamente']);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {$cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->estado = false; // eliminación lógica
            $cliente->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}
