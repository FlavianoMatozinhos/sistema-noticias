<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_post_notification')
            ->subject('Nova notícia no Choquei Conca')
            ->with([
                'userName' => $this->user->name,
                'postTitle' => $this->post->title,
            ])
        ;
    }
}
