<?php

namespace SportStore\Http\Controllers;

use SportStore\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller
{

    protected $carrito;
    function __construct(Carrito $carrito)
    {
        $this->carrito = $carrito;
    }

    function index()
    {
        return view('iniciar_sesion');
    }

    function autenticar(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ], [
            'email.required' => 'El campo e-mail es obligatorio',
            'email.email' => 'Ingrese un e-mail válido. Ej. nombre@servidor.com',
            'password.required' => 'El campo Contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener mínimo cuatro (4) caracteres'
        ]);

        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            $nombre_usuario = \Auth::user()->getPrimerNombre();
            \Utils::enviarMensaje('Éxito','success', "Bienvenido(a) {$nombre_usuario}");
            return redirect()->intended();
        } else {
            \Utils::enviarMensaje('Error', 'danger', 'No se pudo iniciar sesión, su e-mail o contraseña son incorrectas');
            return redirect()->route('autenticacion.index');
        }


    }

    function cerrarSesion()
    {
        Auth::logout();
        $this->carrito->limpiar_carrito();
        return redirect()->route('tienda.index');
    }
}
