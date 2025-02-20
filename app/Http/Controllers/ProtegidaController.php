<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProtegidaController extends Controller
{
    public function protegida_inicio(){
        if(session('perfil_id') == 1){

            return redirect()->route('protegida_sin_acceso');

        }
        return view('protegidas.home');
    }

    public function protegida_otra(){
        return view('protegidas.otra');
    }

    public function protegida_sin_acceso(){
        return view('protegidas.sin_acceso');
    }
}
