<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidateSelect;

class FormularioController extends Controller
{
    public function formulario_inicio(){
        return view('formulario.home');
    }

    public function formulario_simple(){
        $paises=array(
            array('id'=>1,'nombre'=>'Colombia'),
            array('id'=>2,'nombre'=>'Argentina'),
            array('id'=>3,'nombre'=>'Perú'),
            array('id'=>4,'nombre'=>'Chile'),
            array('id'=>5,'nombre'=>'Ecuador'),
            array('id'=>6,'nombre'=>'Venezuela'),
            array('id'=>7,'nombre'=>'Bolivia'),
            array('id'=>8,'nombre'=>'Paraguay'),
            array('id'=>9,'nombre'=>'Uruguay'),
            array('id'=>10,'nombre'=>'Brasil')
        );
        $intereses=array(
            array('id'=>1,'nombre'=>'Programación'),
            array('id'=>2,'nombre'=>'Diseño'),
            array('id'=>3,'nombre'=>'Marketing'),
            array('id'=>4,'nombre'=>'Ventas'),
            array('id'=>5,'nombre'=>'Administración'),
            array('id'=>6,'nombre'=>'Finanzas'),
            array('id'=>7,'nombre'=>'Contabilidad'),
            array('id'=>8,'nombre'=>'Recursos Humanos'),
            array('id'=>9,'nombre'=>'Ingeniería'),
            array('id'=>10,'nombre'=>'Medicina')
        );
        return view('formulario.simple',compact('paises','intereses'));
    }
    public function formulario_simple_post(Request $request){
        $validated = $request->validate(
            [
                'nombre' => 'required|min:3|max:50',
                'apellido' => 'required|min:3|max:50',
                'pais' => ['required', new ValidateSelect],
                'email' => 'required|email:rfc,dns',
                'password' => 'required|string|min:12|max:50|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
                'descripcion' => 'required|min:10|max:500',
            ],[
                'nombre.required' => 'El campo nombre es requerido',
                'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
                'nombre.max' => 'El campo nombre debe tener máximo 50 caracteres',
                'apellido.required' => 'El campo apellido es requerido',
                'apellido.min' => 'El campo apellido debe tener al menos 3 caracteres',
                'apellido.max' => 'El campo apellido debe tener máximo 50 caracteres',
                'email.required' => 'El campo email es requerido',
                'email.email' => 'El campo email debe ser un email válido',
                'password.required' => 'El campo password es requerido',
                'password.string' => 'El campo password debe ser una cadena de texto',
                'password.min' => 'El campo password debe tener al menos 12 caracteres',
                'password.max' => 'El campo password debe tener máximo 50 caracteres',
                'password.confirmed' => 'El campo password no coincide con la confirmación',
                'password.regex' => 'El campo password debe contener al menos una letra minúscula, una letra mayúscula, un número y un caracter especial',
                'descripcion.required' => 'El campo descripción es requerido',
                'descripcion.min' => 'El campo descripción debe tener al menos 10 caracteres',
                'descripcion.max' => 'El campo descripción debe tener máximo 500 caracteres',
            ]
        );
        $intereses=array(
            array('id'=>1,'nombre'=>'Programación'),
            array('id'=>2,'nombre'=>'Diseño'),
            array('id'=>3,'nombre'=>'Marketing'),
            array('id'=>4,'nombre'=>'Ventas'),
            array('id'=>5,'nombre'=>'Administración'),
            array('id'=>6,'nombre'=>'Finanzas'),
            array('id'=>7,'nombre'=>'Contabilidad'),
            array('id'=>8,'nombre'=>'Recursos Humanos'),
            array('id'=>9,'nombre'=>'Ingeniería'),
            array('id'=>10,'nombre'=>'Medicina')
        );

        foreach($intereses as $key=>$interes){
            if(isset($_POST['interes_'.$key])){
                echo $_POST['interes_'.$key].'<br>';
            }
        }
    }


    public function formulario_flash(){
        return view('formulario.flash');
    }
    public function formulario_flash2(Request $request){
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Mensaje desde flash con éxito');
        return redirect()->route('formulario_flash3');
        
    }
    public function formulario_flash3(){
        return view('formulario.flash3');
    }

    public function formulario_upload(){
        return view('formulario.upload');
    }
    public function formulario_upload_post(Request $request){
        $request->validate([
            'foto' => 'required|mimes:jpg,png|max:2040',
        ],[
            'foto.required' => 'El campo foto es requerido',
            'foto.mimes' => 'El campo foto debe ser un foto de tipo: jpg, png',
            'foto.max' => 'El campo foto debe tener un tamaño máximo de 2MB',
        ]);
        switch($request->foto->extension()){
            case 'jpg':
                $archivo='jpeg';
                break;
            case 'png':
                $archivo='png';
                break;
            default:
                $archivo=$request->foto->extension();
                break;
        }
        copy($_FILES['foto']['tmp_name'],'upload/img/'.$archivo);

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','El archivo se subio exitosamente');
        return redirect()->route('formulario_upload');
    }
}
