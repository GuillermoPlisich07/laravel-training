<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\BdController;
use App\Http\Controllers\UtilesController;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\ProtegidaController;
use App\Http\Middleware\Acceso;

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


//////////////////////// BD ////////////////////////
Route::get('/bd', [BdController::class, 'bd_inicio'])->name('bd_inicio');

//Categorias
Route::get('/bd/categorias', [BdController::class, 'bd_categorias'])->name('bd_categorias');
Route::get('/bd/categorias/add', [BdController::class, 'bd_categorias_add'])->name('bd_categorias_add');
Route::post('/bd/categorias/add', [BdController::class, 'bd_categorias_add_post'])->name('bd_categorias_add_post');
Route::get('/bd/categorias/edit/{id}', [BdController::class, 'bd_categorias_edit'])->name('bd_categorias_edit');
Route::post('/bd/categorias/edit{id}', [BdController::class, 'bd_categorias_edit_post'])->name('bd_categorias_edit_post');
Route::get('/bd/categorias/delete/{id}', [BdController::class, 'bd_categorias_delete'])->name('bd_categorias_delete');

//Productos
Route::get('/bd/productos', [BdController::class, 'bd_productos'])->name('bd_productos');
Route::get('/bd/productos/add', [BdController::class, 'bd_productos_add'])->name('bd_productos_add');
Route::post('/bd/productos/add', [BdController::class, 'bd_productos_add_post'])->name('bd_productos_add_post');
Route::get('/bd/productos/edit/{id}', [BdController::class, 'bd_productos_edit'])->name('bd_productos_edit');
Route::post('/bd/productos/edit{id}', [BdController::class, 'bd_productos_edit_post'])->name('bd_productos_edit_post');
Route::get('/bd/productos/delete/{id}', [BdController::class, 'bd_productos_delete'])->name('bd_productos_delete');

//Listado
Route::get('/bd/productos/categorias/{id}', [BdController::class, 'bd_productos_categorias'])->name('bd_productos_categorias');
Route::get('/bd/productos/paginacion', [BdController::class, 'bd_productos_paginacion'])->name('bd_productos_paginacion');
Route::get('/bd/buscador', [BdController::class, 'bd_productos_buscador'])->name('bd_productos_buscador');

//Fotos
Route::get('/bd/productos/fotos/{id}', [BdController::class, 'bd_productos_fotos'])->name('bd_productos_fotos');
Route::post('/bd/productos/fotos/{id}', [BdController::class, 'bd_productos_fotos_post'])->name('bd_productos_fotos_post');
Route::get('/bd/productos/fotos/delete/{producto_id}/{foto_id}', [BdController::class, 'bd_productos_fotos_delete'])->name('bd_productos_fotos_delete');


//////////////////////// Utiles ////////////////////////
Route::get('/utiles', [UtilesController::class, 'utiles_inicio'])->name('utiles_inicio');
Route::get('/utiles/pdf', [UtilesController::class, 'utiles_pdf'])->name('utiles_pdf');
Route::get('/utiles/excel', [UtilesController::class, 'utiles_excel'])->name('utiles_excel');
Route::get('/utiles/client-rest', [UtilesController::class, 'utiles_client_rest'])->name('utiles_client_rest');
Route::get('/utiles/client-soap', [UtilesController::class, 'utiles_client_soap'])->name('utiles_client_soap');


//////////////////////// Acceso ////////////////////////
Route::get('/acceso/login', [AccesoController::class, 'acceso_login'])->name('acceso_login');
Route::post('/acceso/login', [AccesoController::class, 'acceso_login_post'])->name('acceso_login_post');
Route::get('/acceso/registro', [AccesoController::class, 'acceso_registro'])->name('acceso_registro');
Route::post('/acceso/registro', [AccesoController::class, 'acceso_registro_post'])->name('acceso_registro_post');
Route::get('/acceso/salir', [AccesoController::class, 'acceso_salir_post'])->name('acceso_salir_post');

//////////////////////// Protegida ////////////////////////
Route::get('/protegida', [ProtegidaController::class, 'protegida_inicio'])->name('protegida_inicio')->middleware(Acceso::class);
Route::get('/protegida/otra', [ProtegidaController::class, 'protegida_otra'])->name('protegida_otra')->middleware(Acceso::class);
Route::get('/protegida/sin-acceso', [ProtegidaController::class, 'protegida_sin_acceso'])->name('protegida_sin_acceso');