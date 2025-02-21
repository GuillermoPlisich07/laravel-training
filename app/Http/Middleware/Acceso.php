<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Acceso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()==false){
            $request->session()->flash('css','warning');
            $request->session()->flash('mensaje','Debe estar logueado/a para acceder a este contenido.');
            return redirect()->route('acceso_login');
        }
        return $next($request);
    }
}
