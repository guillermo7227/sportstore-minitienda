<?php

namespace SportStore\Jobs;

use SportStore\Orden;
use Illuminate\Bus\Queueable;
use SportStore\Mail\OrdenCompleta;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EmailOrdenCompleta implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orden;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Orden $orden)
    {
        $this->orden = $orden;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = env('EMAIL_TEST', $this->orden->user->email);
        // echo "Enviando Email a {$email}\n";
        Mail::to($email)->send(new OrdenCompleta($this->orden));
    }
}
