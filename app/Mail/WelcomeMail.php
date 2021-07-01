<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
//if i am going to deploy application then i have to make 
//queue:work working to monitor application
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome');
    }
}
