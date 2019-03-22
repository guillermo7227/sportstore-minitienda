<?php

use SportStore\Orden;
use Faker\Generator as Faker;

$factory->define(Orden::class, function (Faker $faker) {
    return [
        'nombre' => "{$faker->firstName} {$faker->lastName}",
        'direccion' => $faker->streetAddress,
        'ciudad' => $faker->city,
        'estado' => $faker->state,
        'codigo_postal' => $faker->postcode,
        'pais' => $faker->country,
    ];
});
