<?php

namespace App\Http\Controllers;


use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        //Segunda Forma
        $categorias = Categoria::select(
            'id',
            'descripcion',
            'estado'
        )

            ->where('estado', true)
            ->orderby('id', 'asc')
            ->get();


        $productos = Categoria::select('id', 'descripcion')
            ->where('estado', true)
            ->get();

        // $categorias = Categoria::select('id', 'descripcion')
        //     ->where('estado', true)
        //     ->get();


        return view('categorias.index', compact(

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
        Categoria::create([
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,

        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        $categoriaFiltrado = Categoria::select(
            'id',
            'descripcion',

        )
            ->where('id', $categoria->id)
            ->where('estado',true)
            //->where('id_usuario', auth()->id())
            ->first();

        if ($categoriaFiltrado) {
            return response()->json($categoriaFiltrado);
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
    public function update(Request $request, Categoria $categoria)
{
    // Verificar autorización
    // if ($producto->id_usuario != auth()->id()) {
    //     return response()->json(['message' => 'No autorizado'], 403);
    // }

    // Validación
    $request->validate([
        'descripcion' => 'required|string|max:255',

    ]);

    // Actualización directa (asumiendo $fillable configurado)
    $categoria->update($request->all());

    return response()->json(['message' => 'Categoria actualizada correctamente']);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {$categoria = Categoria::find($id);
        if ($categoria) {
            $categoria->estado = false; // eliminación lógica
            $categoria->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}
