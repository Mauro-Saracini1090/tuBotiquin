<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaMedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'IBUPROFENO',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'BROMHEXINA',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'AMOXICILINA',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'VILDAGLIPTINA',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'PRAMIPEXOL',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'ACIDO DESOXICOLICO',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'DOXEPINA',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'GLICEROL',
        ]);
        DB::table('marca_medicamentos')->insert([
            'nombre_marca' => 'DEXAMETASONA FOSFATO',
        ]);
    }
}
