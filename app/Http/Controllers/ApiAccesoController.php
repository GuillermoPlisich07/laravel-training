<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMetadata;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiAccesoController extends Controller
{
   
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
        $user = User::where('email', $request->input('email'))->first();
        if(!is_object($user)){
            return response()->json(['response' => [
                'message' => 'Usuario no encontrado',
                'status' => 'Not Found'
            ]], 404);
        }
        $user_metadata = UserMetadata::where('user_id', $user->id)->first();
        if(!is_object($user_metadata)){
            return response()->json(['response' => [
                'message' => 'Usuario no encontrado',
                'status' => 'Not Found'
            ]], 404);
        }
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json(['response' => [
                'message' => 'Las credenciales no coinciden',
                'status' => 'Unauthorized'
            ]], 401);
        }
        
        $payload=[
            'id'=>$user_metadata->id,
            'iat'=>time()
        ];
        $jwt = JWT::encode($payload, env('JWT_KEY'), 'HS512');
        return response()->json(['response' => [
            'message' => 'Acceso concedido',
            'status' => 'OK',
            'nombre' => $user->name,
            'token' => $jwt
        ]], 200);
    }

   
}
