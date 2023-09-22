<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
     public $client;
     public $demande;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client,$demande)
    {
        $this->client = $client;
        $this->demande = $demande;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lokeytion23@gmail.com','LOKEYTION')->subject('Information Client')->markdown('information');
    }
}