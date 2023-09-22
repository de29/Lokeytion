<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormMail extends Mailable
{
    use Queueable, SerializesModels;
    public $link;
    public $annonce;
   /**
    * Create a new message instance.
    *
    * @return void
    */
   public function __construct($annonce,$link)
   {
       $this->link = $link;
       $this->annonce = $annonce;
   }

   /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
       return $this->from('lokeytion23@gmail.com','LOKEYTION')->subject('FEEDBACK')->markdown('feedbackform');
   }
}