<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::getPublishedPosts()->paginate(10); //selektujemo koji su cekirani postovi
                                                        //dodali smo paginaciju
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
        $tags = Tag::all();  //dodaje tagove
        return view('posts.create')->with('tags', $tags);
    }

    public function store()
    {

        $this->validate(  //validacija podtaka prima dva parametra request i asoc niz
            request(),      //prekidamo odmah da ne stigne do baze
            Post::VALIDATION_RULES
        );

       // dd(auth()->user());
        
        // Post::create(
        //     array_merge(                                //da bi kreirao post mora da spoji sve
        //         request()->all(),
        //         [
        //             'author_id' => auth()->user()->id
        //         ]
        //     )
        // );

        $post = new Post;
        $post->title = request('title');
        $post->body = request('body');
        $post->author_id = auth()->user()->id;
        $post->published = true;

        $post->save();

        $post->tags()->attach(request('tags')); //da nakacimo tagove one koje smo selektovati i sad ih cuva u bazi

        return redirect('/posts');
       
    }
}
