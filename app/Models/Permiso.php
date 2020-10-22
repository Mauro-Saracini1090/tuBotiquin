<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_permiso';


    public function getRoles()
    {
        return $this->belongsToMany(Role::class,'roles_permisos', 'rol_id', 'permiso_id');
    }
}
