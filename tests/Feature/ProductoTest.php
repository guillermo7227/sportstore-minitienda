<?php

namespace Tests\Feature;

use Tests\TestCase;
use SportStore\User;
use SportStore\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    function test_carga_pagina_editar_producto()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $producto = factory(Producto::class)->create();

        $this->get("/admin/productos/{$producto->id}/edit")
            ->assertStatus(200)
            ->assertSee('Editar Producto')
            ->assertSee($producto->nombre);
    }

    function test_carga_404_si_producto_no_existe_cuando_editar_producto()
    {
        $this->withoutExceptionHandling();
        $this->expectException(ModelNotFoundException::class);

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $this->get("/admin/productos/24234234/edit");
    }

    function test_actualiza_producto()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $producto = factory(Producto::class)->create();

        $datos = [
            'nombre' => 'bola de softbol',
            'descripcion' => 'bola para jugar softbol',
            'categoria' => 'Softbol',
            'precio' => 1200000,
            'imagen' => 'http://servidor.com/imagen.jpg'
        ];

        $this->withSession(['_token' => 'hola'])
            ->put("/admin/productos/{$producto->id}", array_merge(['_token' => 'hola'], $datos))
            ->assertRedirect('/admin/productos');

        $this->assertDatabaseHas('productos', array_merge(['id' => $producto->id], $datos));

    }

    function test_elimina_un_producto()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $producto = factory(Producto::class)->create();

        $this->withSession(['_token' => 'hola'])
            ->delete("/admin/productos/{$producto->id}", ['_token' => 'hola'])
            ->assertRedirect('/admin/productos');

        $this->assertDatabaseMissing('productos', [
            'id' => $producto->id,
        ]);
    }

    function test_carga_crear_producto()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $producto = factory(Producto::class)->create();

        $this->get('/admin/productos/create')
            ->assertStatus(200)
            ->assertSee('Crear Producto');
    }

    function test_guarda_un_producto()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'rol' => 'admin'
        ]);
        Auth::login($usuario);

        $datos = [
            'nombre' => 'bola de softbol',
            'categoria' => 'Softbol',
            'descripcion' => 'bola para jugar softbol',
            'precio' => 1200000,
            'imagen' => 'http://servidor.com/imagen.jpg'
        ];

        $this->withSession(['_token' => 'hola'])
            ->post('/admin/productos', array_merge(['_token' => 'hola'], $datos))
            ->assertRedirect('/admin/productos');

        $this->assertDatabaseHas('productos', $datos);
    }
}
