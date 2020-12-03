<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeContactoFarmaceutico extends Mailable
{
    use Queueable, SerializesModels;

    // Asunto
    public $subject = "Mensaje enviado";
    //Propiedad declarada como pública [importante]
    public $msjContacto;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensajeContacto)
    {
        //
        $this->msjContacto = $mensajeContacto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.Farmaceutico.mensajeContactoFarmacuetico');
    }
}

