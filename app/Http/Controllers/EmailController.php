<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EjemploMailable;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email_inicio(){
        return view('email.home');
    }
    
    public function email_enviar(Request $request){
        $html = "<h1>Correo de prueba</h1><hr/> hola texto";
        $correo = new EjemploMailable($html);
        Mail::to("bonanni@ort.edu.uy")->send($correo);
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Correo enviado');
        return redirect()->route('email_inicio');
    }
}
