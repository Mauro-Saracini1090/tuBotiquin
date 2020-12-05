<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;

    protected $table = "estados";
    protected $primaryKey = 'id_estados';
    
    protected $fillable = [
        'tipo_estados_id',
        'fecha_caducidad_estados',
        'fecha_solicitud_estados',
    ];
}
