<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMedicamento extends Model
{
    use HasFactory;
    protected $table ="tipo_medicamentos";
    protected $primaryKey = 'id_tipo';

    public function getMedicamentosTipo()
    {
        return $this->hasMany(Medicamento::class,'id_tipo','tipo_id');
    }
}
