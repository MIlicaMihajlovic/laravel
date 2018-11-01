
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
            <!-- postavljanje rute za postove jednog autora -->
            <p>Written by: <a href="/users/{{ $post->author_id }}"> 
            {{ $post->author->name }} </a></p>
            <p> {{ $post->body }} </p>

         </div><!-- /.blog-post -->
        </li>

        <!-- <li><a href="/posts/{{$post->id}}">{{ $post->title }}</a></li> -->
        @endforeach
    </ul>

    <nav class="blog-pagination">
        <a class="btn btn-outline-{{ $posts->currentPage() == 1 ? 'secondary disabled' : 'primary'
        }}" href="{{ $posts->previousPageUrl() }}">Older</a>
        <a class="btn btn-outline-{{ $posts->hasMorePages() ? 'primary' : 'secondary disabled' 
        }}" href="{{ $posts->nextPageUrl() }}">Newer</a>
        Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}
        <!-- pokazuje nam na kojoj smo stranici -->
    </nav>
    <!-- dodavanje paginacije  dugmica a za disabled moramo da napisemo logiku ako nema daljih stranica-->
@endsection