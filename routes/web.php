<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductoController;

use App\Http\Controllers\CategoriaController;

use App\Http\Controllers\ClienteController;

use App\Http\Controllers\CompraController;

use App\Models\Categoria;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/hola_mundo',[App\Http\Controllers\HolaMundoController::class, 'mostrar_hola_mundo'])->name('mostrar_hola_mundo');




Route::get('/users',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');






Route::get('/productos',[App\Http\Controllers\ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos',[App\Http\Controllers\ProductoController::class,'store'])->name('productos.store');
Route::get('/productos_llenar/{producto}',[ProductoController::class,'show'])->name('productos.show');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::post('/productos/destroy/{id}', [ProductoController::class,'destroy'])->name('productos.destroy');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])
    ->name('productos.destroy');


Route::get('/categorias',[App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias',[App\Http\Controllers\CategoriaController::class,'store'])->name('categorias.store');
Route::get('/categorias_llenar/{categoria}',[CategoriaController::class,'show'])->name('categorias.show');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::post('/categorias/destroy/{id}', [CategoriaController::class,'destroy'])->name('categorias.destroy');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])
    ->name('categorias.destroy');


Route::get('/clientes',[App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');
Route::post('/clientes',[App\Http\Controllers\ClienteController::class,'store'])->name('clientes.store');
Route::get('/clientes_llenar/{cliente}',[ClienteController::class,'show'])->name('clientes.show');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::post('/clientes/destroy/{id}', [ClienteController::class,'destroy'])->name('clientes.destroy');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])
    ->name('clientes.destroy');



Route::get('/compras',[App\Http\Controllers\CompraController::class, 'index'])->name('compras.index');
Route::post('/compras',[App\Http\Controllers\CompraController::class,'store'])->name('compras.store');
Route::get('/compras_llenar/{categoria}',[CompraController::class,'show'])->name('compras.show');
Route::put('/compras/{compra}', [CompraController::class, 'update'])->name('compras.update');
Route::post('/compras/destroy/{id}', [CompraController::class,'destroy'])->name('compras.destroy');
Route::delete('/compras/{compra}', [CompraController::class, 'destroy'])
    ->name('compras.destroy');
