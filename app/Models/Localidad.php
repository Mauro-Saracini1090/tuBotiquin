<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidad';
    protected $primaryKey = 'codigo_postal';

    protected $fillable = [
        'nombre_localidad',

    ]; 

    /**
     * Get the Usuario para una Localidad.
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class,'cod_postal','codigo_postal');
    }
}
