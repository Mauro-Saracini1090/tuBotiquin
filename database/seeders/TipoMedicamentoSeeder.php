<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Analgésicos',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Antiácidos y antiulcerosos',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Antialérgicos',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Antiinfecciosos',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Antiinflamatorios',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Antipiréticos',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => ' Antitusivos y mucolíticos',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Digestivos',
        ]);
        DB::table('tipo_medicamentos')->insert([
            'nombre_tipo' => 'Otro',
        ]);
    }
}
