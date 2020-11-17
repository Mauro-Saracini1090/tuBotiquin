<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = "sucursal";
    protected $primaryKey = 'id_sucursal';
    
    protected $fillable = [
        'id_farmacia',
        'descripcion_sucursal',
        'cufe_sucursal',
        'email_sucursal',
        'telefono_sucural',
        'habilitado'
    ];

    public function getFarmacia()
    {
        return $this->belongsTo(Farmacia::class,'id_farmacia','id_farmacia');
    }

     /**
     * The turnos that belong to the sucursal.
     */
    public function getTurnos()
    {
        return $this->belongsToMany(Turno::class,'turno_sucursal','sucursal_id','turno_id');
    }

 
}
