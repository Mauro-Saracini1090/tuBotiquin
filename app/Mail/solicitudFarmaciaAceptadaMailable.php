<?php

namespace App\Mail;

use App\Models\Farmacia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class solicitudFarmaciaAceptadaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Tu Botiquin - Notificacion de Farmacia aceptada";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Farmacia $farmacia)
    {
        //
        $this->farmacia = $farmacia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $farmacia=$this->farmacia;
        return $this->view('emails.Farmaceutico.farmaciaAprobada',compact('farmacia'));
    }
}
