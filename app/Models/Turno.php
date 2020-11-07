<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;
    protected $table = "turno";
    protected $primaryKey = 'id_turno';


    /**
     * The sucursales that belong to the turnos.
     */
    public function getSucursales()
    {
        return $this->belongsToMany(Sucursal::class,'asigna','turno_id','sucursal_id');
    }
}
