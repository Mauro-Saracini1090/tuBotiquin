<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table ="medicamentos";
    protected $primaryKey = 'id_medicamento';


    public function getTipo()
    {
        return $this->belongsTo(TipoMedicamento::class,'tipo_id','id_tipo');
    }
    public function getMarca()
    {
        return $this->belongsTo(MarcaMedicamento::class,'marca_id','id_marca');
    }
    public function getSucursales()
    {
        return $this->belongsToMany(Sucursal::class,'sucursal_medicamento','medicamento_id','sucursal_id')->withPivot('cantidad','cantidadTotal');;
    }
    public function medicamentosReserva()
    {
        return $this->belongsToMany(Reserva::class,'reserva_medicamento','medicamento_id','reserva_id')->withPivot('cantidad');
    }
    //Scope nombre farmacia
    public function scopeNombreMedicamento($query, $nombreMedicamento)
    {
        if ($nombreMedicamento) {
            # code...
            return $query->where('id_medicamento', '=', "$nombreMedicamento");
        }
    }
    //Scope nombre farmacia
    public function scopeTipo($query, $tipo)
    {
        if ($tipo) {
            # code...
            return $query->where('tipo_id', '=', $tipo);
        }
    }
    //Scope nombre farmacia
    public function scopeMarca($query, $marca)
    {
        if ($marca) {
            # code...
            return $query->where('marca_id', '=', $marca);
        }
    }

     //Scope nombre farmacia
     public function scopeNomMedicamento($query, $nombreMedicamento)
     {
         if ($nombreMedicamento) {
             # code...
             return $query->where('nombre_medicamento','LIKE',"$nombreMedicamento%");
         }
     }
}
