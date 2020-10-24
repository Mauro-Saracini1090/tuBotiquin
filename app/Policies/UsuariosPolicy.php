<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Usuario;


class UsuariosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function viewAny(Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function view(Usuario $usu, Usuario $usuario)
    {
        //
        if($usu->getRoles->contains('slug_rol','es-administrador')){
            return true;
        }elseif($usu->getRoles->contains('slug_permiso','ver-usuario')){
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function create(Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function update(Usuario $usu, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function delete(Usuario $usu, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function restore(Usuario $usu, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function forceDelete(Usuario $usu, Usuario $usuario)
    {
        //
    }
}
