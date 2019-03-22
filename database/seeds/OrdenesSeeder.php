<?php

use SportStore\Orden;
use Illuminate\Database\Seeder;

class OrdenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Orden::class)->create([
            'user_id' => 1,
            'total_items' => 3,
            'total_orden' => 1260000,
        ]);
        factory(Orden::class)->create([
            'user_id' => 2,
            'total_items' => 2,
            'total_orden' => 180000,
            'enviado' => true
        ]);
        factory(Orden::class)->create([
            'user_id' => 2,
            'total_items' => 2,
            'total_orden' => 2400000,
        ]);
    }
}
