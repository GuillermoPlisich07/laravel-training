<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Categorias::orderBy('id', 'desc')->get();
        return response()->json($datos,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        if(!is_array($json)){
            return response()->json(['response' => [
                'message' => 'No se han enviado datos',
                'status' => 'Bad Request'
            ]], 400);
        }
        Categorias::create(
            [
                'nombre' => $request->input('nombre'),
                'slug' => Str::of($request->input('nombre'))->slug('-'),
            ]
        );

        return response()->json(['response' => [
            'message' => 'La categoria fue creada correctamente',
            'status' => 'Ok'
        ]], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dato = Categorias::Where('id',$id)->firstOrFail();
        return response()->json($dato,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        if(!is_array($json)){
            return response()->json(['response' => [
                'message' => 'No se han enviado datos',
                'status' => 'Bad Request'
            ]], 400);
        }
        $datos = Categorias::Where('id',$id)->first();
        if(!is_object($datos)){
            return response()->json(['response' => [
                'message' => 'La categoria no existe',
                'status' => 'Bad Request'
            ]], 400);
            
        }else{
            $categoria = Categorias::Where('id',$id)->firstOrFail();
            $categoria->nombre=$request->input('nombre');
            $categoria->slug=Str::of($request->input('nombre'))->slug('-');
            $categoria->save();
            return response()->json(['response' => [
                'message' => 'La categoria fue editada correctamente',
                'status' => 'Ok'
            ]], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $countProductos = Productos::Where('categoria_id',$id)->count();
        if($countProductos>0){
            return response()->json(['response' => [
                'message' => 'La categoria no puede ser eliminada porque tiene productos asociados',
                'status' => 'Bad Request'
            ]], 400);
        }


        Categorias::Where('id',$id)->delete();
        return response()->json(['response' => [
            'message' => 'La categoria fue eliminada correctamente',
            'status' => 'Ok'
        ]], 200);
    }
}
