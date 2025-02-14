<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\BdController;

Route::get('/', [HomeController::class, 'home_inicio'])->name('home_inicio');
Route::get('/hola', [HomeController::class, 'home_hola'])->name('home_hola');
Route::get('/parametros/{id}/{slug}', [HomeController::class, 'home_parametros'])->name('home_parametros');


Route::get('/template', [TemplateController::class, 'template_inicio'])->name('template_inicio');
Route::get('/template/stack', [TemplateController::class, 'template_stack'])->name('template_stack');

Route::get('/formulario', [FormularioController::class, 'formulario_inicio'])->name('formulario_inicio');

Route::get('/formulario/simple', [FormularioController::class, 'formulario_simple'])->name('formulario_simple');
Route::post('/formulario/simple', [FormularioController::class, 'formulario_simple_post'])->name('formulario_simple_post');

Route::get('/formulario/flash', [FormularioController::class, 'formulario_flash'])->name('formulario_flash');
Route::get('/formulario/flash2', [FormularioController::class, 'formulario_flash2'])->name('formulario_flash2');
Route::get('/formulario/flash3', [FormularioController::class, 'formulario_flash3'])->name('formulario_flash3');

Route::get('/formulario/upload', [FormularioController::class, 'formulario_upload'])->name('formulario_upload');
Route::post('/formulario/upload', [FormularioController::class, 'formulario_upload_post'])->name('formulario_upload_post');

Route::get('/helper', [HelperController::class, 'helper_inicio'])->name('helper_inicio');

Route::get('/email', [EmailController::class, 'email_inicio'])->name('email_inicio');
Route::get('/email/send', [EmailController::class, 'email_enviar'])->name('email_enviar');

Route::get('/bd', [BdController::class, 'bd_inicio'])->name('bd_inicio');
Route::get('/bd/categorias', [BdController::class, 'bd_categorias'])->name('bd_categorias');