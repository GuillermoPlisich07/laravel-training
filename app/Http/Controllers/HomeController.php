<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function home_inicio(){
        $text="Hi Guillermo";
        $contador = 12;
        $paises = array(
            array("nombre"=>"Peru", "dominio"=>"pe"),
            array("nombre"=>"Chile", "dominio"=>"cl"),
            array("nombre"=>"Argentina", "dominio"=>"ar"),
            array("nombre"=>"Bolivia", "dominio"=>"bo"),
            array("nombre"=>"Uruguay", "dominio"=>"uy"),
            array("nombre"=>"Paraguay", "dominio"=>"py"),
            array("nombre"=>"Ecuador", "dominio"=>"ec"),
            array("nombre"=>"Colombia", "dominio"=>"co"),
            array("nombre"=>"Venezuela", "dominio"=>"ve"),
            array("nombre"=>"Brasil", "dominio"=>"br")
        );

        // return view('home.home', ["text"=>$text]);
        return view('home.home', compact('text', 'contador','paises'));
    }
    public function home_hola(){
        echo "Hola desde hola de controlador";
    }
    public function home_parametros($id,$slug){
        echo "id=".$id."| slug=".$slug;
    }
}
