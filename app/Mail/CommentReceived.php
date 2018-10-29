<?php

namespace App\Mail;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentReceived extends Mailable
{
    use Queueable, SerializesModels;
    
    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Post $post) //kad smo ovde prosledili post moramo i u commentsController  pri instanciranju CommentReceived
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('posts.comment_received');
    }
}
