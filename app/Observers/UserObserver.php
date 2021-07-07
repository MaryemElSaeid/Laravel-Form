<?php

namespace App\Observers;

use App\Models\User;
use App\Mail\AttachmentMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use DB;

class UserObserver
{
    private $current_user;

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->sendEmailToAdmin($user->id);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }

     public function sendEmailToUser($id)
    {
        // $user = new User;
        $this->current_user  = DB::table('users')->find($id);
        $userEmail = $this->current_user->email;
        Mail::to($userEmail)->send(new WelcomeMail());
        // return new WelcomeMail();
    }

    public function sendEmailToAdmin($id) 
    {
        $this->sendEmailToUser($id);
        Mail::to('admin@admin.com')->send(new AttachmentMail($this->current_user->email));
    }
}
