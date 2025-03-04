<?php

use App\Http\Controllers\ApiAccesoController;
use App\Http\Controllers\ApiCategoriaController;
use App\Http\Controllers\ApiProductoController;
use App\Http\Controllers\ApiProductoFotosController;
use App\Http\Controllers\EjemploController;
use App\Http\Middleware\Verifiacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/v1/ejemplo', EjemploController::class);
Route::resource('/v1/categorias', ApiCategoriaController::class);
// Middleware JWT
Route::resource('/v1/productos', ApiProductoController::class)->middleware(Verifiacion::class);
//Middleware Basica
// Route::middleware('auth.basic')->resource('/v1/productos', ApiProductoController::class);
Route::resource('/v1/productos-fotos', ApiProductoFotosController::class);
Route::resource('/v1/login',ApiAccesoController::class);