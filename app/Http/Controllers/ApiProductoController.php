<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\ProductosFotos;
use Illuminate\Support\Str;


class ApiProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Productos::orderBy('id', 'desc')->get();
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
        Productos::create(
            [
                'nombre' => $request->input('nombre'),
                'slug' => Str::of($request->input('nombre'))->slug('-'),
                'descripcion' => $request->input('descripcion'),
                'precio' => $request->input('precio'),
                'categoria_id' => $request->input('categoria_id'),
                'fecha' => date('Y-m-d'),
            ]
        );

        return response()->json(['response' => [
            'message' => 'El Producto fue creada correctamente',
            'status' => 'Ok'
        ]], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dato = Productos::Where('id',$id)->firstOrFail();
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
        $datos = Productos::Where('id',$id)->first();
        if(!is_object($datos)){
            return response()->json(['response' => [
                'message' => 'El producto no existe',
                'status' => 'Not Found'
            ]], 404);
        }else{
            $productos = Productos::Where('id',$id)->firstOrFail();
            $productos->nombre=$request->input('nombre');
            $productos->slug=Str::of($request->input('nombre'))->slug('-');
            $productos->descripcion=$request->input('descripcion');
            $productos->precio=$request->input('precio');
            $productos->categoria_id=$request->input('categoria_id');
            $productos->save();
            return response()->json(['response' => [
                'message' => 'El Producto fue editada correctamente',
                'status' => 'Ok'
            ]], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $countProductosFotos = ProductosFotos::Where('productos_id',$id)->count();
        if($countProductosFotos>0){
            return response()->json(['response' => [
                'message' => 'El producto no puede ser eliminada porque tiene Fotos asociadas',
                'status' => 'Bad Request'
            ]], 400);
        }


        Productos::Where('id',$id)->delete();
        return response()->json(['response' => [
            'message' => 'El producto fue eliminada correctamente',
            'status' => 'Ok'
        ]], 200);
    }
}
