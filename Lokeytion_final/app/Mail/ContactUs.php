<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;
    public $sujet;
    public $nom;
    public $message;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $sujet,$nom,$message,$email)
    {
     $this->message = $message;
     $this->sujet = $sujet;
     $this->nom = $nom; 
     $this->email = $email;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lokeytion23@gmail.com')->subject($this->sujet)->markdown('ContactUs');
    }
}
