<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccesoController extends Controller
{
    public function acceso_login(){
        return view('acceso.login');
    }

    public function acceso_login_post(Request $request){
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8'
        ],
        [
            'correo.required' => 'El campo correo es obligatorio',
            'correo.email' => 'El campo correo debe ser un correo válido',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $usuario = UserMetadata::where('user_id',Auth::user()->id)->first();
            $request->session()->put('users_metadata_id',$usuario);
            $request->session()->put('perfil_id',$usuario->perfil_id);
            $request->session()->put('perfil',$usuario->perfil->nombre);
            return redirect()->intended('/template');
        }else{
            $request->session()->flash('css','danger');
            $request->session()->flash('mensaje','Las credenciales no coinciden');
            return redirect()->route('acceso_login');
        }
    }

    public function acceso_registro(){
        return view('acceso.registro');
    }

    public function acceso_registro_post(Request $request){
        $request->validate([
            'nombre' => 'required|min:3',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'password' => 'required|min:8|confirmed',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser un email válido',
            'email.unique' => 'El email ya está registrado',
            'telefono.required' => 'El campo teléfono es obligatorio',
            'telefono.numeric' => 'El campo teléfono debe ser un número',
            'direccion.required' => 'El campo dirección es obligatorio',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);
        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user_metadata= new UserMetadata();
        $user_metadata->user_id = $user->id;
        $user_metadata->telefono = $request->telefono;
        $user_metadata->direccion = $request->direccion;
        $user_metadata->perfil_id = 1;
        $user_metadata->save();

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','El usuario se agrego exitosamente');
        return redirect()->route('acceso_registro');

    }

    public function acceso_salir_post(Request $request){
        Auth::logout();
        $request->session()->forget('users_metadata_id');
        $request->session()->forget('perfil_id');
        $request->session()->forget('perfil');

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Cierre de sesion exitosamente');
        return redirect()->route('acceso_login');
    }
}
