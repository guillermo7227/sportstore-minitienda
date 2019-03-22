<?php

namespace SportStore\Http\Controllers;

use SportStore\Carrito;
use SportStore\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    protected $carrito;

    function __construct(Carrito $carrito)
    {
        $this->carrito = $carrito;
    }

    public function agregar(Producto $producto) //??
    {
        // if (!is_null($id)) { //?? esto qué??
            // $producto = Producto::find($id);
            $this->carrito->agregar_producto($producto, 1);
        // }
        return redirect()->route('carrito.index');
    }

    public function index()
    {

        return view('tienda.carrito')
            ->with('carrito', $this->carrito);
    }

    public function limpiar() {
        $this->carrito->limpiar_carrito();
        \Utils::enviarMensaje('Info', 'info', 'El Carrito ha sido limpiado.');
        return redirect()->route('tienda.index');
    }

    public function modificarCantidad(Request $request, Producto $producto) {
        $request->validate([
            'cantidad' => 'integer|min:1'
        ], [
            'cantidad.min' => 'Error: La cantidad debe ser mayor a cero'
        ]);
        // $producto = Producto::find($id);
        $cantidad = $request->cantidad;
        $this->carrito->modificar_cantidad($producto, $cantidad);

        \Utils::enviarMensaje('Éxito', 'success', 'La cantidad se ha modificado satisfactoriamente');

        return redirect()->route('carrito.index');
    }

    function eliminar(Producto $producto) {
        // $producto = Producto::find($id);
        $this->carrito->eliminar_producto($producto);

        \Utils::enviarMensaje('Éxito', 'success', 'El producto ha sido eliminado del carrito satisfactoriamente');

        return redirect()->route('carrito.index');
    }

}
