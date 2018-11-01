<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->with('author')->latest()->paginate(10);  //jer smo prosledili ceo objekat ne moramo da uzimamo iz modela nego odmah tag

        return view('posts.index')->with('posts', $posts);
    }
}
