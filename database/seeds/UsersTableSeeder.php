<?php

use SportStore\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Guillermo Agudelo',
            'email' => 'guille@agudelo.com',
            'password' => Hash::make('guille')
        ]);
        factory(User::class)->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'rol' => 'admin'
        ]);
        // if (\Config::get('database.default') == 'pgsql') {
        //     echo "Preparando PGSQL autoincrement";
        //     User::statement("SELECT setval('users_id_seq', (SELECT MAX(id) from 'users'));");
        //     // User::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id),1), false) FROM users;");
        // }
        factory(User::class, 2)->create();
    }
}
