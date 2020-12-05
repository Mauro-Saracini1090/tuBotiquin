<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*INSERT INTO localidad(codigo_postal,  nombre_localidad) VALUES 
            (8328,'Allen'),
            (8300,'Neuquen'),
            (8324, 'Cipolletti'),
            (8309, 'Centenario'),
            (8303, 'Cinco Salto'),
            (8316, 'Plottier'),
            (8320, 'Senillosa'),
            (111111, 'Otra'); 
        */
        DB::table('localidad')->insert([
            'codigo_postal' => 8328,
            'nombre_localidad' => 'Allen',
        ]);
        DB::table('localidad')->insert([
            'codigo_postal' => 8300,
            'nombre_localidad' => 'Neuquen',
        ]);
        DB::table('localidad')->insert([
            'codigo_postal' => 8324,
            'nombre_localidad' => 'Cipolletti',
        ]);
        DB::table('localidad')->insert([
            'codigo_postal' => 8309,
            'nombre_localidad' => 'Centenario',
        ]);
        DB::table('localidad')->insert([
            'codigo_postal' => 8303,
            'nombre_localidad' => 'Cinco Salto',
        ]);
        DB::table('localidad')->insert([
            'codigo_postal' => 8316,
            'nombre_localidad' => 'Plottier',
        ]);
        DB::table('localidad')->insert([
            'codigo_postal' => 8320,
            'nombre_localidad' => 'Senillosa',
        ]);
        DB::table('localidad')->insert([
            'codigo_postal' => 111111,
            'nombre_localidad' => 'Otra',
        ]);
        
    }
}
