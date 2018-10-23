<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::getPublishedPosts(); //selektujemo koji su cekirani postovi

        return view('posts.index', ['posts' => $posts]); //vracamo view
    }

    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id); //find ce biti lazyloading sa with je egr
                                                    //prvo pisemo with nadji mi post sa komentarima a find nadji mi samo post
        //dd($post); //pre returna moramo

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {

        $this->validate(  //validacija podtaka prima dva parametra request i asoc niz
            request(),      //prekidamo odmah da ne stigne do baze
            Post::VALIDATION_RULES
        );

        Post::create(request()->all());

        return redirect('/posts');

       
    }
}
