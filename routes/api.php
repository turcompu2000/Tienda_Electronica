<?php

use App\Http\Controllers\api\ProductosController;
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
