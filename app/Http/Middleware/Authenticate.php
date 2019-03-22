<?php

namespace SportStore\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // dd(session()->all());
            $msg = 'Por favor autentíquece para continuar';
            \Utils::enviarMensaje('Advertencia', 'warning', $msg);

            return route('autenticacion.index');

            // return abort(401, 'Debe estar autenticado para ver esta página');
        }
    }
}
