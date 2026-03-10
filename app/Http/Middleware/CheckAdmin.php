<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!Auth::check() || Auth::user()->perfil !== 'admin') {
            
            // Se cair em qualquer uma das condições, bloqueia e manda para o login
            return redirect('/login')->with('error', 'Acesso restrito a administradores.');
        }

        // Se for admin, permite que a requisição continue para a rota desejada
        return $next($request);
    }
}