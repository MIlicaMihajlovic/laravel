<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store($id)
    {
        $post = Post::findOrFail($id); //ako ne nadje post da izbaci gresku
            
        //validacija pre kreiranja komentara
        
        $this->validate(  //validacija podtaka prima dva parametra request i asoc niz
            request(),      //prekidamo odmah da ne stigne do baze
            Comment::VALIDATION_RULES
        );

        $post->comments()->create( //sa zagradama mozemo da radimo CRUD kod commentsa
            request()->all()
        ); 

        return redirect("/posts/{$id}"); //moraju biti dvostruki navodnici
    }
}
