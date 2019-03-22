<?php

namespace Tests\Feature;

use Tests\TestCase;
use SportStore\User;
use SportStore\Carrito;
use SportStore\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use SportStore\Http\Middleware\Authenticate;
use SportStore\Http\Middleware\VerificarRol;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    function test_carga_iniciar_sesion_cuando_pagina_admin_sin_autenticar()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware([Authenticate::class, VerificarRol::class]);
        // $this->expectException(HttpException::class);
        // $this->expectExceptionMessage('Debe estar autenticado para ver esta página');


        $response = $this->get('/admin');

        $response->assertSee('Iniciar sesión');
    }

    function test_no_carga_modulo_admin_sin_rol_admin()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create();
        Auth::login($usuario);

        try {
            $response = $this->get('/admin');
        } catch (\Throwable $th) {}

        $this->assertEquals($th->getStatusCode(), 403);
    }

    function test_carga_modulo_admin_con_rol_admin()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);


        $response = $this->get('/admin')
            ->assertStatus(200)
            ->assertSee('Administración');


    }

    function test_admin_carga_productos()
    {
        $this->withoutExceptionHandling();
        factory(Producto::class)->create([
            'nombre' => 'Balón GOLTY Profesional',
            'categoria' => 'Fútbol'
        ]);
        factory(Producto::class)->create([
            'nombre' => 'Xbox One Slim',
            'categoria' => 'Juegos Electrónicos'
        ]);

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $this->get('/admin/productos')
            ->assertStatus(200)
            ->assertSee('Balón GOLTY Profesional')
            ->assertSee('Xbox One Slim');
    }

    function test_admin_carga_ordenes()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $producto1 = factory(Producto::class)->create([
            'nombre' => 'Balón GOLTY Profesional',
            'categoria' => 'Fútbol'
        ]);
        $producto2 = factory(Producto::class)->create([
            'nombre' => 'Xbox One Slim',
            'categoria' => 'Juegos Electrónicos'
        ]);

        $carrito = new Carrito;
        $carrito->agregar_producto($producto1, 2);
        $carrito->agregar_producto($producto2, 1);

        $datos_envio = [
            '_token' => 'hola',
            'user_id' => $usuario->id,
            'nombre' => 'Nombre test',
            'direccion' => 'Calle 89',
            'ciudad' => 'Honk Kong',
            'estado' => 'Guajira',
            'codigo_postal' => '200401',
            'pais' => 'Boliiva'
        ];

        $this->withSession(['_token' => 'hola'])
            ->post(route('ordenes.store'), $datos_envio);

        $this->get('/admin/ordenes')
            ->assertStatus(200)
            ->assertSee('Nombre test')
            ->assertSee('Balón GOLTY Profesional')
            ->assertSee('Xbox One Slim');
    }

}
