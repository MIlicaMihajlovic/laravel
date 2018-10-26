
@extends('layouts.master') 
<!-- nasledjujemo master koji je u folderu layouts -->

@section('title')
    All posts

@endsection

@section('content')

    <a href="/posts/create">
        <button type="submit" class="btn btn-primary">Create new post</button>
    </a>    

   <h1>Posts</h1> 
   
    <ul>
        @foreach($posts as $post)
        <li>
         <div class="blog-post">
            <h2 class="blog-post-title">
                <a href="/posts/{{$post->id}}">
                    {{$post->title}}
                </a>     
            </h2>
            <p>Written by: {{ $post->author->name }}</p>
            <p> {{ $post->body }} </p>

         </div><!-- /.blog-post -->
        </li>

        <!-- <li><a href="/posts/{{$post->id}}">{{ $post->title }}</a></li> -->
        @endforeach
    </ul>
@endsection