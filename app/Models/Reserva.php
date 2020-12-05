<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = "reserva";
    protected $primaryKey = 'id_reserva';
    
    protected $fillable = [
        'numero_reserva',
        'usuario_id',
        'estados_id',
    ];

}
