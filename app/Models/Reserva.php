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
        'sucursal_id',
        'fecha_caducidad_estados',
        'fecha_solicitud_estados',
    ];

    public function getSucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id', 'id_sucursal');
    }

    public function getEstado()
    {
        return $this->belongsTo(Estados::class,'estados_id','id_estados');
    }
    /**
     * The Medicamentos that belong to the sucursal.
     */
    public function reservaMedicamentos()
    {
        return $this->belongsToMany(Medicamento::class,'reserva_medicamento','reserva_id','medicamento_id')->withPivot('cantidad');
    }

    public function reservaUsuario()
    {
        return $this->belongsTo(Usuario::class,'usuario_id','id_usuario');
    }

    public function scopeEstado($query, $estado)
    {
        if ($estado) {
            # code...
            return $query->where('estados_id', '=', $estado);
        }
    }
    public function scopeFechaSolicitud($query, $fechaSolicitud)
    {
        if ($fechaSolicitud) {
            # code...
            return $query->where('fecha_solicitud_estados', '=', $fechaSolicitud);
        }
    }
    public function scopeFechaVencimiento($query, $fechaCaducidad)
    {
        if ($fechaCaducidad) {
            # code...
            return $query->where('fecha_caducidad_estados', '=', $fechaCaducidad);
        }
    }
}
