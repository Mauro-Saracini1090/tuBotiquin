<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rol';
    protected $fillable = [
        'nombre_rol',
        'slug_rol',
    ];  

    public function getPermisos()
    {
        return $this->belongsToMany(Permiso::class,'roles_permisos', 'rol_id', 'permiso_id');
    }
}
