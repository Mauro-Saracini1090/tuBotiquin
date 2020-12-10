<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('estados')->insert([
            'descripcion_tipo_estados' => 'Solicitado',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'descripcion_tipo_estados' => 'Rechazada',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'descripcion_tipo_estados' => 'Aceptada',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'descripcion_tipo_estados' => 'Caducado',
        ]);

    }
}
