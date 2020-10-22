<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rol';

    public function getPermisos()
    {
        return $this->belongsToMany(Permiso::class,'roles_permisos', 'rol_id', 'permiso_id');
    }
    
    //ESTO EL CHABON DE TUTORIAL NO LO HACE POSIBLEMENTE TENGA QUE BORRAR
    public function getUsuarios()
    {
        return $this->belongsToMany(Usuario::class,'usuario_roles');
    }
}
