<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table ="usuario";
    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'nombre_usuario',
        'email',
        'password',
        'cod_postal',
        'cuil',
        'cuit',
        'dni',
        'numero_matricula',
        'habilitado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class,'cod_postal','codigo_postal');
    }


    //ESTO EL CHABON DE TUTORIAL NO LO HACE POSIBLEMENTE TENGA QUE BORRAR
    public function getPermisosUsuario()
    {
        return $this->belongsToMany(Permiso::class,'usuario_permisos');
    }
}
