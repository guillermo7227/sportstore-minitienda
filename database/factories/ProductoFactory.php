<?php

use Faker\Generator as Faker;

$factory->define(SportStore\Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence(2),
        'categoria' => $faker->randomElement(['Básketbol', 'Juegos Electrónicos', 'Fútbol']),
        'descripcion' => $faker->sentence(4),
        'precio' => $faker->randomFloat(2, 10, 50000),
        'imagen' => ''
    ];
});
