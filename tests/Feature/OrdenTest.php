<?php

namespace Tests\Feature;

use Tests\TestCase;
use SportStore\User;
use SportStore\Orden;
use SportStore\Carrito;
use SportStore\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdenTest extends TestCase
{
    use RefreshDatabase;

    private $usuario;
    private $producto;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->usuario = factory(User::class)->create(['rol' => 'admin']);
        Auth::login($this->usuario);

        $this->producto = factory(Producto::class)->create();
        $carrito = new Carrito;
        $carrito->agregar_producto($this->producto, 1);
    }

    function test_guarda_orden_carrito_lleno()
    {
        // $this->withoutMiddleware(Authenticate::class);

        $response = $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), [
                '_token' => 'hola',
                'user_id' => $this->usuario->id,
                'nombre' => 'Nombre test',
                'direccion' => 'Calle 89',
                'ciudad' => 'Honk Kong',
                'estado' => 'Guajira',
                'codigo_postal' => '200401',
                'pais' => 'Boliiva'
            ]);

        $response->assertStatus(200)
            ->assertSee('¡Gracias por su compra!');
        $this->assertDatabaseHas('ordenes', ['user_id' => $this->usuario->id, 'nombre' => 'Nombre test']);
        $this->assertDatabaseHas('detalles_orden', ['producto_id' => $this->producto->id]);

    }

    function test_elimina_orden()
    {

        $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), [
                '_token' => 'hola',
                'user_id' => $this->usuario->id,
                'nombre' => 'Nombre test',
                'direccion' => 'Calle 89',
                'ciudad' => 'Honk Kong',
                'estado' => 'Guajira',
                'codigo_postal' => '200401',
                'pais' => 'Boliiva'
            ]);

        $orden = Orden::first();
        $this->withSession(['_token' => 'hola'])
            ->delete("/admin/ordenes/{$orden->id}", ['_token' => 'hola'])
            ->assertRedirect('/admin/ordenes');
        $this->assertDatabaseMissing('detalles_orden', ['orden_id' => 1]);
        $this->assertDatabaseMissing('ordenes', ['id' => 1]);
    }

    function test_marcar_orden_como_enviada()
    {

        $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), [
                '_token' => 'hola',
                'user_id' => $this->usuario->id,
                'nombre' => 'Nombre test',
                'direccion' => 'Calle 89',
                'ciudad' => 'Honk Kong',
                'estado' => 'Guajira',
                'codigo_postal' => '200401',
                'pais' => 'Boliiva'
            ]);

        $orden = Orden::first();
        $this->withSession(['_token' => 'hola'])
            ->put("/admin/ordenes/{$orden->id}/enviar", [
                '_token' => 'hola',
                'enviado' => true
            ])
            ->assertRedirect('/admin/ordenes');

        $this->assertDatabaseHas('ordenes', [
            'id' => $orden->id,
            'enviado' => true
        ]);
    }

    function test_muestra_ordenes_enviadas()
    {

        $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), [
                '_token' => 'hola',
                'user_id' => $this->usuario->id,
                'nombre' => 'Nombre test 3',
                'direccion' => 'Calle 89',
                'ciudad' => 'Honk Kong',
                'estado' => 'Guajira',
                'codigo_postal' => '200401',
                'pais' => 'Boliiva'
            ]);

        $orden = Orden::first();

        $this->withSession(['_token' => 'hola'])
            ->put("/admin/ordenes/{$orden->id}/enviar", [
                '_token' => 'hola',
                'enviado' => true
            ]);

        $this->call('GET', '/admin/ordenes', ['mostrarEnviadas' => true])
            ->assertStatus(200)
            ->assertSee($this->producto->nombre);

    }

    function test_carga_vista_orden()
    {

        $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), [
                '_token' => 'hola',
                'user_id' => $this->usuario->id,
                'nombre' => 'Nombre test 3',
                'direccion' => 'Calle 89',
                'ciudad' => 'Honk Kong',
                'estado' => 'Guajira',
                'codigo_postal' => '200401',
                'pais' => 'Boliiva'
            ]);

        $orden = Orden::first();

        $this->get('/admin/ordenes/'.$orden->id)
                ->assertStatus(200)
                ->assertSee('Detalles de la Orden')
                ->assertSee($orden->id)
                ->assertSee($orden->nombre)
                ->assertSee($this->producto->nombre);

    }

    public function testCargaMisOrdenes()
    {

        $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), [
                '_token' => 'hola',
                'user_id' => $this->usuario->id,
                'nombre' => 'Nombre test 3',
                'direccion' => 'Calle 89',
                'ciudad' => 'Honk Kong',
                'estado' => 'Guajira',
                'codigo_postal' => '200401',
                'pais' => 'Boliiva'
            ]);

        $orden = Orden::first();

        $this->get(route('ordenes.misordenes'))
            ->assertStatus(200)
            ->assertSee('Mis Órdenes')
            ->assertSee($orden->nombre)
            ->assertSee($this->producto->nombre);
    }
}
