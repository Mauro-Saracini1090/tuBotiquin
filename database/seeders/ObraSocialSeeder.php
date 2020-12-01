<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObraSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**INSERT INTO obra_social (id_obra_social, Nombre_obra_social, Telefono_obra_Social, created_at, updated_at) VALUES
            (1, 'Sosunc', 123456789, NULL, NULL),
            (2, 'Osde', 8798798, NULL, NULL),
            (3, 'Swiss Medical', 8797987, NULL, NULL),
            (4, 'Luis Pasteur', 65489651, NULL, NULL),
            (5, 'OSPE', 79878945, NULL, NULL),
            (6, 'OSFE', 54564561, NULL, NULL),
            (7, 'OSPIM', 1591591, NULL, NULL),
            (8, 'OSPIT', 3219518, NULL, NULL),
            (9, 'Galeno', 1239518, NULL, NULL); 
        */
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'Sosunc',
            'Telefono_obra_Social' => 123456789,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'Osde',
            'Telefono_obra_Social' => 8798798,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'Swiss Medical',
            'Telefono_obra_Social' => 8797987,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'Luis Pasteur',
            'Telefono_obra_Social' => 65489651,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'OSPE',
            'Telefono_obra_Social' => 79878945,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'OSPIM',
            'Telefono_obra_Social' => 54564561,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'OSPIT',
            'Telefono_obra_Social' => 1591591,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'OSFE',
            'Telefono_obra_Social' => 3219518,
        ]);
        DB::table('obra_social')->insert([
            'Nombre_obra_social' => 'Galeno',
            'Telefono_obra_Social' => 1239518,
        ]);
    }
}
