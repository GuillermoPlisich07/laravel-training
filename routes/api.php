<?php

use App\Http\Controllers\ApiCategoriaController;
use App\Http\Controllers\ApiProductoController;
use App\Http\Controllers\EjemploController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/v1/ejemplo', EjemploController::class);
Route::resource('/v1/categorias', ApiCategoriaController::class);
Route::resource('/v1/productos', ApiProductoController::class);