<?php

namespace SportStore\Http\Controllers;

use SportStore\Carrito;
use SportStore\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TiendaController extends Controller
{

    protected $carrito;

    public function __construct(Carrito $carrito) {
        $this->carrito = $carrito;
    }

    public function index()
    {
        $productos = Producto::orderBy('id')->paginate(5);
        $categorias = Producto::all()->pluck('categoria')->unique();

        return view('tienda.tienda')
            ->with('productos', $productos)
            ->with('categorias', $categorias)
            ->with('categoria_actual', 'Todos los productos');
    }

    public function mostrarPorCategoria($categoria)
    {
        $productos_filtrados = Producto::orderBy('id')->where('categoria', $categoria)->paginate(4);
        $categorias = Producto::all()->pluck('categoria')->unique();

        return view('tienda.tienda')
            ->with('productos', $productos_filtrados)
            ->with('categorias', $categorias)
            ->with('categoria_actual', $categoria);
    }

    function acercaDe()
    {
        return view('tienda.acercade');
    }

    function mostrarAdmin()
    {
        return view('admin.admin');
    }

    public function test()
    {
        // \Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message) {
        //     $message->subject('Mailgun and Laravel are awesome!');
        //     // $message->from('no-reply@website_name.com', 'Website Name');
        //     $message->to('guilleagudelo@vivaldi.net');
        // });
        // $email = 'guilleagudelo@vivaldi.net';
        // // \Mail::to($email)->send(new OrdenCompleta($this->orden));
    }
}
