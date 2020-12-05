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
        'usuario_id',
        'descripcion_sucursal',
        'cufe_sucursal',
        'email_sucursal',
        'telefono_fijo',
        'telefono_movil',
        'direccion_sucursal',
        'habilitado',
        'borrado_logico_sucursal',
    ];

    public function getFarmacia()
    {
        return $this->belongsTo(Farmacia::class,'id_farmacia','id_farmacia');
    }

    public function getFarmaceutico()
    {
        return $this->belongsTo(Usuario::class,'usuario_id','id_usuario');
    
    }

     /**
     * The turnos that belong to the sucursal.
     */
    public function getTurnos()
    {
        return $this->belongsToMany(Turno::class,'turno_sucursal','sucursal_id','turno_id');
    }

    /**
     * The Medicamentos that belong to the sucursal.
     */
    public function getMedicamentos()
    {
        return $this->belongsToMany(Medicamento::class,'sucursal_medicamento','sucursal_id','medicamento_id')->withPivot('cantidad','cantidadTotal');;
    }

 
}
