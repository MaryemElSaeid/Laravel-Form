<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AttachmentMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use DB;

class EmailsController extends Controller
{
    public function sendEmailToUser($id)
    {
        //i want to access user who sent the form
        $user = new User;
        // dd($user->id);
        $current_user  = DB::table('users')->where("id","=",$id)->first();
        // dd($current_user);
        $userEmail = $current_user->email;
        Mail::to($userEmail)->send(new WelcomeMail());
        return new WelcomeMail();
    }

    public function sendEmailToAdmin($id) 
    {
        // dd($id);
        $this->sendEmailToUser($id);
        Mail::to('admin@admin.com')->send(new AttachmentMail($id));
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