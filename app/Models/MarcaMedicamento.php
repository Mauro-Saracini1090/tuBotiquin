<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaMedicamento extends Model
{
    use HasFactory;
    protected $table ="marca_medicamentos";
    protected $primaryKey = 'id_marca';
}
