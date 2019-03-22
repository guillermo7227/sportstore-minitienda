<?php

namespace Tests\Feature;

use Tests\TestCase;
use SportStore\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutenticacionTest extends TestCase
{
    use RefreshDatabase;

    function test_carga_pagina_iniciar_sesion()
    {
        $response = $this->get(route('autenticacion.index'));

        $response->assertStatus(200)
            ->assertSee('Iniciar Sesión');
    }

    function test_usuario_puede_autenticarse()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create([
            'email' => 'pepe@locuaz.com',
            'password' => Hash::make('pepe')
        ]);

        $datos = [
            '_token' => 'hola',
            'email' => 'pepe@locuaz.com',
            'password' => 'pepe'
        ];

        $response = $this->withSession([
            '_token' => 'hola'
        ])->call('GET', route('autenticacion.autenticar'), $datos);

        $this->assertAuthenticated();
    }

    function test_usuario_puede_cerrar_sesion()
    {
        $this->withoutExceptionHandling();

        $usuario = factory(User::class)->create();

        Auth::login($usuario);
        $this->assertAuthenticated();

        $this->get(route('autenticacion.cerrarsesion'))
            ->assertRedirect('/');

        $this->assertGuest();
    }

}
