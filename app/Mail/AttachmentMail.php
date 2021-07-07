<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class AttachmentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    public $id;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
  
        return $this->markdown('emails.attachment')
        ->subject('Request Confirmation')
        ->attach(public_path('User'.$this->id.'.pdf'));
    }
}