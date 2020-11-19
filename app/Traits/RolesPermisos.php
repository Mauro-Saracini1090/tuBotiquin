<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permiso;

/**
 * 
 */
trait RolesPermisos
{
    public function getRoles()
    {
        return $this->belongsToMany(Role::class, 'usuario_roles', 'usuario_id', 'rol_id');
    }

    public function getPermisos()
    {
        return $this->belongsToMany(Permiso::class, 'usuario_permisos', 'usuario_id', 'permiso_id');
    }

    public function tieneRole($rol)
    {

        if ($this->getRoles->contains('slug_rol', $rol)) {
            return true;
        }
        return false;
    }
}
