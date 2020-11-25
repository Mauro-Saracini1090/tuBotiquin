<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class solicitudSucursalAceptadaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Tu Botiquin - Notificacion de Sucursal Aceptada";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.Farmaceutico.sucursalAprobada');
    }
}
