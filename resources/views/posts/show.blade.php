
@extends('layouts.master')

@section('title')

    {{ $post->title}}
    
@endsection

@section('content')  
<a href="/posts">
    All posts
</a> 

    <div class="blog-post">
        <h2 class="blog-post-title">
            
                {{$post->title}}
        </h2>
        
        <p> {{ $post->body }} </p>

     </div><!-- /.blog-post -->
@endsection    
    
  
    
    
