<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TemplateController;

Route::get('/', [HomeController::class, 'home_inicio'])->name('home_inicio');
Route::get('/hola', [HomeController::class, 'home_hola'])->name('home_hola');
Route::get('/parametros/{id}/{slug}', [HomeController::class, 'home_parametros'])->name('home_parametros');


Route::get('/template', [TemplateController::class, 'template_inicio'])->name('template_inicio');

