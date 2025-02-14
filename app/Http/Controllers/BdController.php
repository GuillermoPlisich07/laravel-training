<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class BdController extends Controller
{
    public function bd_inicio(){
        return view('bd.home');
    }


    public function bd_categorias(){

        $categorias = Categorias::get()->orderBy('nombre','desc');
        // dd($categorias);
        return view('bd.categorias',compact('categorias'));
    }
}
