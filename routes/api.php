<?php

use App\Http\Controllers\api\ProductosController;
use App\Http\Controllers\api\VentasController;
use App\Http\Controllers\api\ClientesController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
Route::get('/productos', [ProductosController::class, 'index'])->name('productos');
Route::delete('/productos/{producto}', [ProductosController::class, 'destroy'])->name('productos.destroy');
Route::get('/productos/{producto}', [ProductosController::class, 'show'])->name('productos.show');
Route::put('/productos/{producto}', [ProductosController::class, 'update'])->name('productos.update');

Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas');
Route::delete('/ventas/{venta}', [VentasController::class, 'destroy'])->name('ventas.destroy');
Route::get('/ventas/{venta}', [VentasController::class, 'show'])->name('ventas.show');
Route::put('/ventas/{venta}', [VentasController::class, 'update'])->name('ventas.update');

Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes');
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');
Route::get('/clientes/{cliente}', [ClientesController::class, 'show'])->name('clientes.show');
Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');