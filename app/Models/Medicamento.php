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
}
