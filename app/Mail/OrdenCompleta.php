<?php

namespace SportStore\Mail;

use SportStore\Orden;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrdenCompleta extends Mailable
{
    use Queueable, SerializesModels;

    protected $orden;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Orden $orden)
    {
        $this->orden = $orden;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orden_completa')
            ->with('orden', $this->orden);
    }
}
