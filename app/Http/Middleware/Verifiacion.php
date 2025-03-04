<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Verifiacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headers = explode(' ',$request->header('Authorization'));
        if(!isset($headers[1])){
            return response()->json(['response' => [
                'message' => 'No se ha enviado el token',
                'status' => 'Unauthorized'
            ]], 401);

        }
        try {
            $decoded = JWT::decode($headers[1], new Key(env('JWT_KEY'), 'HS512'));
        } catch (\Throwable $th) {
            return response()->json(['response' => [
                'message' => "El token fallo o no es valido",
                'status' => 'Unauthorized'
            ]], 401);
        }
        $fecha = time();
        if($decoded->iat > $fecha){
            return response()->json(['response' => [
                'message' => 'Acceso denegado',
                'status' => 'Unauthorized'
            ]], 401);

        }
        return $next($request);
    }
}
