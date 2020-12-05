<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\RolesPermisos;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable,RolesPermisos;

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
        'telefono_movil',
        'cuil',
        'cuit',
        'dni',
        'numero_matricula',
        'img_perfil',
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

    public function getFarmacias()
    {
        return $this->hasMany(Farmacia::class,'id_usuario');
    }
    public function getSucursales()
    {
        return $this->hasMany(Sucursal::class,'id_usuario','usuario_id');
    }


    
}
