<?php

namespace App\Http\Controllers;

use App\Models\ProductosFotos;
use Illuminate\Http\Request;

class ApiProductoFotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = ProductosFotos::orderBy('id', 'desc')->get();
        return response()->json($datos,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(empty($_FILES['foto']['tmp_name'])){
            return response()->json(['response' => [
                'message' => 'No se han enviado la foto',
                'status' => 'Bad Request'
            ]], 400);

        }else if($_FILES['foto']['type'] != 'image/jpeg' && $_FILES['foto']['type'] != 'image/png'){
            return response()->json(['response' => [
                'message' => 'El archivo no es una imagen',
                'status' => 'Bad Request'
            ]], 400);
        }else{

            $id = $request->input('productos_id');
            switch($request->foto->extension()){
                case 'jpg':
                    $archivo=time().'jpeg';
                    break;
                case 'png':
                    $archivo=time().'png';
                    break;
                default:
                    $archivo=time().$request->foto->extension();
                    break;
            }
            copy($_FILES['foto']['tmp_name'],'/var/www/html/clases/ejemplo_1/public/upload/productos/'.$archivo);

            $foto_bd = new ProductosFotos();
            $foto_bd->productos_id = $id;
            $foto_bd->nombre = $archivo;
            $foto_bd->save();

            return response()->json(['response' => [
                'message' => 'La foto fue agregada correctamente',
                'status' => 'Ok'
            ]], 200);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos = ProductosFotos::Where('productos_id',$id)->orderBy('id', 'desc')->get();
        return response()->json($datos,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $foto = ProductosFotos::Where('id',$id)->firstOrFail();
        unlink('/var/www/html/clases/ejemplo_1/public/upload/productos/'.$foto->nombre);
        $foto->delete();
        return response()->json(['response' => [
            'message' => 'La foto fue eliminada correctamente',
            'status' => 'Ok'
        ]], 200);
    }
}
