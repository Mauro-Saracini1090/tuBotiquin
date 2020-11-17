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
    ];

    // Para obtener el dueno de la farmacia
    public function usuarioFarmaceutico()
    {
        return $this->hasMany(Usuario::class,'id_usuario');
    }

    //Para obtener todas las sucursales
    public function getSucursales()
    {
        return $this->belongsT(Sucursal::class,'id_farmacia');
    }



    public function obrasSociales()
    {
        return $this->belongsToMany(ObraSocial::class, 'obra_social_farmacia', 'obra_social_id', 'farmacia_id');
    }
    

}
