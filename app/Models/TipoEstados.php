<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEstados extends Model
{
    use HasFactory;

    protected $table = "tipo_estados";
    protected $primaryKey = 'id_tipo_estados';
    
    protected $fillable = [
        'descripcion_tipo_estados',
    ];

}
