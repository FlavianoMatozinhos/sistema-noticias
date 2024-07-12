<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendNewPostNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewPostNotification($user, $event->post));
        }
    }
}
