<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
            !Auth::user()->hasVerifiedEmail()) {

            return redirect()->route('verification.notice')->withErrors([
                'email' => 'Debe verificar su dirección de correo electrónico antes de iniciar sesión.'
            ]);
        }

        return $next($request);
    }
}
