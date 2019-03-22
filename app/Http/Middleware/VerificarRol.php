<?php

namespace SportStore\Http\Middleware;

use Closure;

class VerificarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $rol)
    {
        if (! \Auth::user()->tieneRol($rol)) {
            abort(403, 'Usted no tiene permiso para realizar esta acción');
        }

        return $next($request);
    }
}
