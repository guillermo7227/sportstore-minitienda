<?php

namespace SportStore\Misc;

class Utils
{
     /**
     * Envía un mensaje para mostrar en pantalla en el siguiente request
     *
     * @param  string  $tipo
     * @param  string  $clase
     * @param  string  $mensaje
     * @return void
     */
    public static function enviarMensaje(string $tipo, string $clase, string $mensaje)
    {
        \Session::flash('mensaje', [
            'tipo' => $tipo,
            'clase' => $clase,
            'msg' => $mensaje
        ]);
    }
}
