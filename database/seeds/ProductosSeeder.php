<?php

use SportStore\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Producto::class)->create([
            'nombre' => 'Balón de Fútbol GOLTY',
            'descripcion' => 'Balón de fútbol profesional N° 15',
            'categoria' => 'Fútbol',
            'precio' => 30000,
            'imagen' => 'https://raw.githubusercontent.com/guillermo7227/recursos/master/sportstore/img-productos/golty.jpg',
        ]);
        factory(Producto::class)->create([
            'nombre' => 'Xbox One Slim',
            'descripcion' => 'Consola de videojuegos Xbox One Slim 320GB',
            'categoria' => 'Juegos Electrónicos',
            'precio' => 1200000,
            'imagen' => 'https://github.com/guillermo7227/recursos/raw/master/sportstore/img-productos/xboxone-slim.webp',
        ]);
        factory(Producto::class)->create([
            'nombre' => 'Zapatillas Nike Stretch',
            'descripcion' => 'Zapatillas para ejercicio con tecnología Stretch',
            'categoria' => 'Ejercicio',
            'precio' => 150000,
            'imagen' => 'https://github.com/guillermo7227/recursos/raw/master/sportstore/img-productos/zapatillas-nike.jpg',
        ]);
        factory(Producto::class, 20)->create();
    }
}
