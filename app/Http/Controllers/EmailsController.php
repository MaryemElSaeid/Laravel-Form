<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AttachmentMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Bus;
use DB;

class EmailsController extends Controller 
{
    public function sendEmailToUser($id)
    {
        $user = new User;
        $current_user  = DB::table('users')->where("id","=",$id)->first();
        $userEmail = $current_user->email;
        Mail::to($userEmail)->send(new WelcomeMail());
        return new WelcomeMail();
    }

    public function sendEmailToAdmin($id) 
    {
        $this->sendEmailToUser($id);
        Mail::to('admin@admin.com')->send(new AttachmentMail($id));
    }
   
}
