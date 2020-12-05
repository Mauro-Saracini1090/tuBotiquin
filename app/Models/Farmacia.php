<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmacia extends Model
{
    use HasFactory;
    protected $table = "farmacia";
    protected $primaryKey = 'id_farmacia';

    protected $fillable = [
        'id_usuario',
        'nombre_farmacia',
        'img_farmacia',
        'descripcion_farmacia',
        'cuit',
        'habilidata',
        'borrado_logico_farmacia',
    ];

    // Para obtener el dueno de la farmacia
    public function usuarioFarmaceutico()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    //Para obtener todas las sucursales
    public function getSucursales()
    {
        return $this->hasMany(Sucursal::class, 'id_farmacia', 'id_farmacia');
    }



    public function obrasSociales()
    {
        return $this->belongsToMany(ObraSocial::class, 'obra_social_farmacia', 'farmacia_id', 'obra_social_id');
    }

    //Scope nombre farmacia
    public function scopeNombreFarmacia($query, $nombreFarmacia)
    {
        if ($nombreFarmacia) {
            # code...
            return $query->where('nombre_farmacia', 'LIKE', "%$nombreFarmacia%");
        }
    }
}
