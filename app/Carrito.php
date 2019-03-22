<?php

namespace SportStore;

use SportStore\Producto;
use Illuminate\Database\Eloquent\Model;

/**
 * El Carrito para guardar productos
 */
class Carrito extends Model
{
    protected $total_carrito = 0.0;
    protected $lineas = [];
    protected $total_items = 0;

    function __construct($datos = null) {
        if ($datos) {
            $this->total_carrito = $datos['total_carrito'];
            $this->lineas = $datos['lineas'];
            $this->total_items = $datos['total_items'];
        }
    }

    function total_carrito() {
        $carrito = session()->get('carrito');
        return $carrito->total_carrito;
    }
    function lineas() {
        $carrito = session()->get('carrito');
        return $carrito->lineas;
    }
    function total_items() {
        $carrito = session()->get('carrito');
        return $carrito->total_items;
    }

    function agregar_producto(Producto $producto, int $cantidad) {
        // que pasa si ya esta el producto en carrito
        $carrito = session()->get('carrito');
        foreach ($carrito->lineas as $key => $linea) {
            if ($producto->id == $linea['producto']->id) { //está en carrito
                $carrito->lineas[$key]['cantidad'] += $cantidad;
                $carrito->lineas[$key]['total_linea'] = $linea['producto']->precio * $carrito->lineas[$key]['cantidad'];
                return $this->recalcular_carrito();
            }
        }
        $carrito->lineas[] = [
            'producto' => $producto,
            'cantidad' => $cantidad,
            'total_linea' => $producto->precio * $cantidad
        ];
        $this->recalcular_carrito();
    }

    protected function recalcular_carrito() {
        $total_carrito = 0.0;
        $total_items = 0;
        $carrito = session()->get('carrito');
        foreach ($carrito->lineas as $linea) {
            $total_carrito += $linea['total_linea'];
            $total_items += $linea['cantidad'];
        }
        $carrito->total_carrito = $total_carrito;
        $carrito->total_items = $total_items;
    }

    function limpiar_carrito() {
        session()->forget('carrito');
    }

    function modificar_cantidad(Producto $producto, $cantidad) {
        $carrito = session()->get('carrito');
        foreach ($carrito->lineas as $key => $linea) {
            if ($producto->id == $linea['producto']->id) {
                $carrito->lineas[$key]['cantidad'] = $cantidad;
                $carrito->lineas[$key]['total_linea'] = $linea['producto']->precio * $carrito->lineas[$key]['cantidad'];
                return $this->recalcular_carrito();
            }
        }
    }

    function eliminar_producto(Producto $producto) {
        $carrito = session()->get('carrito');
        foreach ($carrito->lineas as $key => $linea) {
            if ($producto->id == $linea['producto']->id) {
                unset($carrito->lineas[$key]);
                $carrito->lineas = array_values($carrito->lineas);
                return $this->recalcular_carrito();
            }
        }
    }

    function carrito_vacio()
    {
        return count($this->lineas()) === 0;
    }
}
