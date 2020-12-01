<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuario')->insert([
            'nombre' => 'Administrador',
            'apellido'=>'Administrador',
            'nombre_usuario'=> 'adminTuBotiquin1',
            'email'=> 'administrador@gmail.com',
            'password'=> bcrypt('123456789'),
            'cod_postal'=> 8328,
            'telefono_movil'=> '298412345678',
            // 'cuil'=> ,
            // 'cuit'=> ,
            // 'dni'=> ,
            // 'numero_matricula'=> ,
            'habilitado'=> 1,
        ]);
    }
}
