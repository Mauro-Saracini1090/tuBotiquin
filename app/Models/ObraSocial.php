<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraSocial extends Model
{
    use HasFactory;
    protected $table ="obra_social";
    protected $primaryKey = 'id_obra_social';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nombre_obra_social',
        'Telefono_obra_social',
    ]; 

    public function farmacias()
    {
        return $this->belongsToMany(Farmacia::class,'obra_social_farmacia', 'obra_social_id', 'farmacia_id');
    }
}
