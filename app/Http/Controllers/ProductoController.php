<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        


        //Segunda Forma
        $productos = Producto::select(
            'id',
            'nombre',
            'codigo_barras',
            'precio_venta',
            'cantidad_stock',
            'estado'
        )

            ->where('estado', true)
            ->orderby('id', 'asc')
            ->get();


        $productos = Producto::select('id', 'nombre', 'codigo_barras', 'precio_venta', 'cantidad_stock')
            ->where('estado', true)
            ->get();

        $categorias = Categoria::select('id', 'descripcion')
            ->where('estado', true)
            ->get();


        return view('productos.index', compact(
            'productos',
            'categorias',
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


        //Crear el nuevo producto
        Producto::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'codigo_barras' => $request->codigo_barras,
            'precio_venta' => $request->precio_venta,
            'cantidad_stock' => $request->cantidad_stock,
            'estado' => $request->estado,

        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $productoFiltrado = Producto::select(
            'id',
            'nombre',
            'codigo_barras',
            'precio_venta',
            'cantidad_stock',
            'categoria_id'
        )
            ->where('id', $producto->id)
            ->where('estado',true)
            //->where('id_usuario', auth()->id())
            ->first();

        if ($productoFiltrado) {
            return response()->json($productoFiltrado);
        }

        return response()->json(
            ['message' => 'Producto no encontrado'],
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
    public function update(Request $request, Producto $producto)
{
    // Verificar autorización
    // if ($producto->id_usuario != auth()->id()) {
    //     return response()->json(['message' => 'No autorizado'], 403);
    // }

    // Validación
    $request->validate([
        'nombre' => 'required|string|max:255',
        'categoria_id' => 'required|integer|exists:tbl_categorias,id',
        'codigo_barras' => 'nullable|string|max:255',
        'precio_venta' => 'required|numeric|min:0',
        'cantidad_stock' => 'required|integer|min:0',
    ]);

    // Actualización directa (asumiendo $fillable configurado)
    $producto->update($request->all());

    return response()->json(['message' => 'Producto actualizado correctamente']);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {$producto = Producto::find($id);
        if ($producto) {
            $producto->estado = false; // eliminación lógica
            $producto->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}
