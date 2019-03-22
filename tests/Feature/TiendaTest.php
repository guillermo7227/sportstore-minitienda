<?php

namespace Tests\Feature;

use Tests\TestCase;
use SportStore\User;
use SportStore\Carrito;
use SportStore\Producto;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use SportStore\Http\Middleware\Authenticate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TiendaTest extends TestCase
{
    use RefreshDatabase;

    // public $mockConsoleOutput = false;

    public function testCargaPaginaHome()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Todos los productos');
    }

    public function testCargaPaginaUnaCategoria()
    {
        $producto = factory(Producto::class)->create([
            'categoria' => 'Futbol'
        ]);

        $this->withoutExceptionHandling();
        $response = $this->get('/categoria/futbol');
        $response->assertStatus(200)
            ->assertSee('Futbol');
    }

    function test_carga_nueva_orden_carrito_lleno()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware(Authenticate::class);

        $usuario = factory(User::class)->create();
        Auth::login($usuario);

        $carrito = new Carrito;
        $producto = factory(Producto::class)->create();

        $carrito->agregar_producto($producto, 1);

        $response = $this->get(route('ordenes.create'));

        $response->assertStatus(200)
            ->AssertSee('Información de envío');
    }

    function test_no_carga_nueva_orden_carrito_vacio()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware(Authenticate::class);
        $usuario = factory(User::class)->create();
        Auth::login($usuario);

        $response = $this->get(route('ordenes.create'));

        $response->assertRedirect('/carrito')
            ->assertSessionHas('mensaje');
    }

    function test_no_guarda_orden_carrito_vacio()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware(Authenticate::class);

        $usuario = factory(User::class)->create();
        Auth::login($usuario);

        $response = $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), [
                '_token' => 'hola',
                'user_id' => $usuario->id,
                'nombre' => 'Pepe Locuaz',
                'direccion' => 'Calle 89',
                'ciudad' => 'Honk Kong',
                'estado' => 'Guajira',
                'codigo_postal' => '200401',
                'pais' => 'Boliiva'
            ]);

        $response->assertRedirect('/carrito')
            ->assertSessionHas('mensaje');
    }

    function test_muestra_nombre_usuario_cuando_autenticado()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'name' => 'Pedro Locuaz',
            'email' => 'pepe@locuaz.com',
            'password' => Hash::make('pepe')
        ]);

        Auth::login($usuario);

        $response = $this->get('/')
            ->assertSee('Carrito de Pedro');
    }

    function test_no_carga_orden_cuando_completa_orden_sin_autenticar()
    {
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $carrito = new Carrito;
        $producto = factory(Producto::class)->create();

        $carrito->agregar_producto($producto, 1);

        $this->get(route('ordenes.create'));
    }

}
