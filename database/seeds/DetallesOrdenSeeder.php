<?php

use SportStore\DetalleOrden;
use Illuminate\Database\Seeder;

class DetallesOrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DetalleOrden::class)->create([
            'orden_id' => 1,
            'producto_id' => 1,
            'nombre' => 'Balón de Fútbol GOLTY',
            'descripcion' => 'Balón de fútbol profesional N° 15',
            'categoria' => 'Fútbol',
            'precio' => 30000,
            'cantidad' => 2,
            'total_linea' => 60000
        ]);

        factory(DetalleOrden::class)->create([
            'orden_id' => 1,
            'producto_id' => 2,
            'nombre' => 'Xbox One Slim',
            'descripcion' => 'Consola de videojuegos Xbox One Slim 320GB',
            'categoria' => 'Juegos Electrónicos',
            'precio' => 1200000,
            'cantidad' => 1,
            'total_linea' => 1200000
        ]);

        factory(DetalleOrden::class)->create([
            'orden_id' => 2,
            'producto_id' => 3,
            'nombre' => 'Zapatillas Nike Stretch',
            'descripcion' => 'Zapatillas para ejercicio con tecnología Stretch',
            'categoria' => 'Ejercicio',
            'precio' => 150000,
            'cantidad' => 1,
            'total_linea' => 150000
        ]);

        factory(DetalleOrden::class)->create([
            'orden_id' => 2,
            'producto_id' => 1,
            'nombre' => 'Balón de Fútbol GOLTY',
            'descripcion' => 'Balón de fútbol profesional N° 15',
            'categoria' => 'Fútbol',
            'precio' => 30000,
            'cantidad' => 1,
            'total_linea' => 30000
        ]);

        factory(DetalleOrden::class)->create([
            'orden_id' => 3,
            'producto_id' => 2,
            'nombre' => 'Xbox One Slim',
            'descripcion' => 'Consola de videojuegos Xbox One Slim 320GB',
            'categoria' => 'Juegos Electrónicos',
            'precio' => 1200000,
            'cantidad' => 2,
            'total_linea' => 2400000
        ]);

    }
}
