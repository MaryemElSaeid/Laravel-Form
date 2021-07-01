<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AttachmentMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    public function sendEmailToUser()
    {
        //i want to access user who sent the form
        // $user = new User;
        // $userEmail = $user->email;
        Mail::to('user@user.com')->send(new WelcomeMail());
        return new WelcomeMail();
    }

    public function sendEmailToAdmin() 
    {
        $this->sendEmailToUser();
        Mail::to('admin@admin.com')->send(new AttachmentMail());
    }


   
    
}


// public function sendEmailToAdmin()
// {
//     //i want to send two emails at once for admin and user with different views
//     // $user = new User;
//     // $userEmail = $user->email;

//     Mail::to('admin@admin.com')->send(new WelcomeMail());
//     Mail::to('user@user.com')->send(new WelcomeMail());
//     return new WelcomeMail();
// }