<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use App\Models\ProductosFotos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BdController extends Controller
{
    
    public function bd_inicio(){
        return view('bd.home');
    }

    //Listados
    public function bd_productos_categorias($id){
        $categoria = Categorias::where('id',$id)->firstOrFail();
        $productos = Productos::where('categoria_id',$id)->get();
        // dd($productos);
        return view('bd.productos_categorias',compact('categoria','productos'));
    }

    //Fotor-Prductos
    public function bd_productos_fotos($id){
        $producto = Productos::where('id',$id)->firstOrFail();
        $fotos = ProductosFotos::where('productos_id',$id)->get();
        return view('bd.productos_fotos',compact('producto','fotos'));
    }
    public function bd_productos_fotos_post(Request $request, $id){
        $producto = Productos::where('id',$id)->firstOrFail();
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'foto.required' => 'El campo foto es obligatorio',
            'foto.image' => 'El campo foto debe ser una imagen',
            'foto.mimes' => 'El campo foto debe ser una imagen jpeg,png,jpg,gif',
            'foto.max' => 'El campo foto debe tener un tamaño maximo de 2MB',
        ]);
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

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','La foto se agrego exitosamente');
        return redirect()->route('bd_productos_fotos',$id);
    }
    public function bd_productos_fotos_delete(Request $request, $producto_id, $foto_id){
        $producto = Productos::where('id',$producto_id)->firstOrFail();
        $foto = ProductosFotos::where('id',$foto_id)->firstOrFail();
        if(file_exists('/var/www/html/clases/ejemplo_1/public/upload/productos/'.$foto->nombre)){
            unlink('/var/www/html/clases/ejemplo_1/public/upload/productos/'.$foto->nombre);
        }
        ProductosFotos::where('id',$foto_id)->delete();
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','La foto se elimino exitosamente');
        return redirect()->route('bd_productos_fotos',['id'=>$producto_id]);
    }

    //Categorias
    public function bd_categorias(){

        $categorias = Categorias::get()->sortByDesc('id');
        // dd($categorias);
        return view('bd.categorias',compact('categorias'));
    }
    public function bd_categorias_add(){
        return view('bd.categorias_add');
    }
    public function bd_categorias_add_post(Request $request){
        $request->validate([
            'nombre' => 'required|min:3|max:100',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'nombre.max' => 'El campo nombre debe tener como máximo 100 caracteres',
        ]);
        $categoria = new Categorias();
        $categoria->nombre = $request->input('nombre');
        $categoria->slug = Str::of($request->input('nombre'))->slug('-');
        $categoria->save();
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','La categoria se agrego exitosamente');
        return redirect()->route('bd_categorias');
    }
    public function bd_categorias_edit($id){

        $categoria = Categorias::where('id',$id)->firstOrFail();
        return view('bd.categorias_edit', compact('categoria'));
    }
    public function bd_categorias_edit_post(Request $request,$id){
        
        $request->validate([
            'nombre' => 'required|min:3|max:100',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'nombre.max' => 'El campo nombre debe tener como máximo 100 caracteres',
        ]);
        $categoria = Categorias::where('id',$id)->firstOrFail();

        $categoria->nombre = $request->input('nombre');
        $categoria->slug = Str::of($request->input('nombre'))->slug('-');
        $categoria->save();
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','La categoria se actualizo exitosamente');
        return redirect()->route('bd_categorias');

    }
    public function bd_categorias_delete(Request $request,$id){

        if(Productos::where('categoria_id',$id)->count() == 0){
            Categorias::where('id',$id)->delete();
            $request->session()->flash('css','success');
            $request->session()->flash('mensaje','La categoria se elimino exitosamente');
            return redirect()->route('bd_categorias');
        }else{
            $request->session()->flash('css','danger');
            $request->session()->flash('mensaje','No es posible eliminar la categoria');
            return redirect()->route('bd_categorias');
        }
    }

    //Productos
    public function bd_productos(){
        $productos = Productos::get()->sortByDesc('id');
        // dd($productos);
        return view('bd.productos',compact('productos'));
    }
    public function bd_productos_add(){
        $categorias = Categorias::get();
        return view('bd.productos_add', compact('categorias'));
    }
    public function bd_productos_add_post(Request $request){

        $request->validate(
            [
                'nombre' => 'required|min:6',
                'precio' => 'required|numeric',
                'descripcion' => 'required|min:10',

            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.min' => 'El campo nombre debe tener al menos 6 caracteres',
                'precio.required' => 'El campo precio es obligatorio',
                'precio.numeric' => 'El campo precio debe ser un numero',
                'descripcion.required' => 'El campo descripcion es obligatorio'
            ]
        );
        $producto = new Productos();
        $producto->nombre = $request->input('nombre');
        $producto->slug = Str::of($request->input('nombre'))->slug('-');
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->fecha = date('Y-m-d');
        $producto->save();

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','El producto se agrego exitosamente');
        return redirect()->route('bd_productos');
    }

    public function bd_productos_edit($id){
        $producto = Productos::where('id',$id)->firstOrFail();
        $categorias = Categorias::get();
        return view('bd.productos_edit', compact('producto','categorias'));
    }

    public function bd_productos_edit_post(Request $request,$id){
        
        $request->validate(
            [
                'nombre' => 'required|min:6',
                'precio' => 'required|numeric',
                'descripcion' => 'required|min:10',

            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.min' => 'El campo nombre debe tener al menos 6 caracteres',
                'precio.required' => 'El campo precio es obligatorio',
                'precio.numeric' => 'El campo precio debe ser un numero',
                'descripcion.required' => 'El campo descripcion es obligatorio'
            ]
        );
        $producto = Productos::where('id',$id)->firstOrFail();
        $producto->nombre = $request->input('nombre');
        $producto->slug = Str::of($request->input('nombre'))->slug('-');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->save();

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','El producto se actualizo exitosamente');
        return redirect()->route('bd_productos');

    }

    public function bd_productos_delete(Request $request,$id){

        $producto = Productos::where('id',$id)->firstOrFail();
        if(ProductosFotos::where('productos_id',$id)->count() == 0){
            Productos::where('id',$id)->delete();
            $request->session()->flash('css','success');
            $request->session()->flash('mensaje','La producto se elimino exitosamente');
            return redirect()->route('bd_productos');
        }else{
            $request->session()->flash('css','danger');
            $request->session()->flash('mensaje','No es posible eliminar el producto');
            return redirect()->route('bd_productos');
        }
    }

    //Paginacion
    public function bd_productos_paginacion(){
        $productos = Productos::orderBy('id','desc')->paginate(env('PAGINACION'));
        return view('bd.productos_paginacion',compact('productos'));
    }

    //Busqueda
    public function bd_productos_buscador(){
        if(isset($_GET['b'])){
            $b=$_GET['b'];
            $productos = Productos::where('nombre','like','%'.$_GET['b'].'%')->get();
        }else{
            $b='';
            $productos = Productos::orderBy('id', 'desc')->get();
        }
        return view('bd.buscador', compact('productos'));
    }


}
