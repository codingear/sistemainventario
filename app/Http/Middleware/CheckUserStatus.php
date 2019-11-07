<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //  dd(Auth::user()->status);

        if (Auth::check() && Auth::user()->status == false) {
            Auth::logout();
            return redirect('/login')->with('error', 'Lo sentimos tu cuenta ha sido suspendida
            temporalmente, ponte en contacto con un Administrador.');
        }

        return $next($request);
    }
}
