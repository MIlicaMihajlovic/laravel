<?php

namespace App\Http\Controllers;

use App\Mail\CommentReceived; //kao i ovo
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;  //ovo smo dodatno usovali

class CommentsController extends Controller
{
    public function store($postId)
    {
        $post = Post::findOrFail($postId); //ako ne nadje post da izbaci gresku

        
            
        //validacija pre kreiranja komentara
        
        $this->validate(  //validacija podtaka prima dva parametra request i asoc niz
            request(),      //prekidamo odmah da ne stigne do baze
            Comment::VALIDATION_RULES
        );

        $post->comments()->create( //sa zagradama mozemo da radimo CRUD kod commentsa
            request()->all()
        ); 

        

        Mail::to($post->author->email)->send(new CommentReceived($post)); //ovde smo prosledili post kad smo ga instancirali
                                        //posle send sta saljemo instanca ono sto smo napravili
        return redirect("/posts/{$postId}"); //moraju biti dvostruki navodnici
    }


    public function destroy($postId, $commentId)
    {
        $comment = Comment::findOrFail($commentId); //nadji
        $comment->delete(); //brisanje iz baze 

        return redirect("/posts/{$postId}"); //vrati na stranicu tog posta

        //dd(compact(['postId', 'commentId']));
    }
}
