<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'nombre_rol' => 'Administrador',
            'slug_rol' => 'es-administrador',
        ]);
        DB::table('roles')->insert([
            'nombre_rol' => 'Farmaceutico',
            'slug_rol' => 'es-farmaceutico',
        ]);
        DB::table('roles')->insert([
            'nombre_rol' => 'Registrado',
            'slug_rol' => 'es-registrado',
        ]);
    }
}
