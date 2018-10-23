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
        $post = Post::findOrFail($id);

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
            [
                'title' => 'required',    //validacija na bekendu
                'body' => 'required | min:25', // prava crta | nam pomaze da dodamo jos neki uslov
                'published' => 'required'
            ]
        );

        Post::create(request()->all());

        return redirect('/posts');

       
    }
}
