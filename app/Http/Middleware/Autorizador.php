<?php

namespace vapj\Http\Middleware;

use Closure;

class Autorizador
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
        if ($request->is('login') && !\Auth::guest()){
            return redirect('/');
        }

        if ($request->is('cadastro') && !\Auth::guest()){
            return redirect('/');
        }


        return $next($request);
    }
}
