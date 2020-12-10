<?php

namespace App\Mail;

use App\Models\Reserva;
use App\Models\Sucursal;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class reservaRealizadaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Tu Botiquin - Se ha Realizado un reserva- Requiere su atencion";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reserva $infoReserva)
    {
        //
        $this->reserva = $infoReserva;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $infoReserva=$this->reserva;
        return $this->view('emails.Farmaceutico.farmaciaAprobada',compact('infoReserva'));
    }
}
