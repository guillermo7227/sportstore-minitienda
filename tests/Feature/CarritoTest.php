<?php

namespace Tests\Feature;

use Tests\TestCase;
use SportStore\Carrito;
use SportStore\Producto;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarritoTest extends TestCase
{
    use RefreshDatabase;

    function testCargaPaginaCarrito()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/carrito');
        $response->assertStatus(200)
            ->assertSee('Tu Carrito');
    }

    function testLimpiaCarrito()
    {
        $this->withoutExceptionHandling();

        $carrito = new Carrito;
        $producto = factory(Producto::class)->create();
        $carrito->agregar_producto($producto, 1);

        $response = $this->get('/carrito/limpiar');
        $response->assertRedirect('/')
            ->assertSessionMissing('carrito');
    }

    function test_carrito_agrega_producto()
    {
        $this->withoutExceptionHandling();

        $producto = factory(Producto::class)->create();
        $datos = [
            'total_carrito' => $producto->precio,
            'total_items' => 1,
            'lineas' => [
                [
                    'cantidad' => 1,
                    'total_linea' => $producto->precio,
                    'producto' => $producto,
                ]
            ]
        ];
        $carrito = new Carrito($datos);
        $carrito->limpiar_carrito();
        session()->put('carrito', new Carrito);

        $response = $this->get("/carrito/agregar/{$producto->id}");

        session()->get('carrito')->wasRecentlyCreated = $carrito->wasRecentlyCreated;
        session()->get('carrito')->lineas()[0]['producto']->wasRecentlyCreated = true;

        $response->assertRedirect('/carrito')
            ->assertSessionHas('carrito', $carrito);

    }

    function test_carrito_elimina_producto()
    {
        $this->withoutExceptionHandling();

        $carrito = new Carrito;
        $carrito->limpiar_carrito();
        session()->put('carrito', $carrito);

        $producto = factory(Producto::class)->create();
        $carrito->agregar_producto($producto, 1);

        $response = $this->get("/carrito/eliminar/{$producto->id}");

        $response->assertRedirect('/carrito')
            ->assertSessionHas('carrito', new Carrito);
    }

    function test_carrito_modifica_cantidad()
    {
        $this->withoutExceptionHandling();

        $carrito = new Carrito;
        $producto = factory(Producto::class)->create();

        $carrito->agregar_producto($producto, 1);

        $response = $this->withSession(['_token' => 'hola'])
            ->call('GET', route('carrito.modificarcantidad', ['producto' => $producto->id]), [
                '_token' => 'hola',
                'cantidad' => 2
            ]);

        $datos = [
            'total_carrito' => $producto->precio * 2,
            'total_items' => 2,
            'lineas' => [
                [
                    'cantidad' => 2,
                    'total_linea' => $producto->precio * 2,
                    'producto' => $producto,
                ]
            ]
        ];
        $carrito_modificado = new Carrito($datos);

        $response->assertRedirect('/carrito')
            ->assertSessionHas('carrito', $carrito_modificado);

    }

}
