@extends('layouts.master')


@section('title')
    Create post 
@endsection    

@section('content')

<form method="POST" action="/posts">
 

    {{ csrf_field() }}

     <div class="form-group">

    <label>Title</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="Enter title">
    @include('layouts.partials.error-message', ['field' => 'title'])  
  </div>
 
  <div class="form-group">
    <label>Body</label>
    <textarea name="body" type="text" class="form-control" id="title" placeholder="Enter body"></textarea>
    @include('layouts.partials.error-message', ['field' => 'body']) 
  </div>

  <div class="form-check">
    <input name="published" type="checkbox" checked="true" value="1" class="form-check-input">
    <label class="form-check-label" for="exampleCheck1">Publish this post?</label>
  </div>

  <div class="form-group">
    <label>Select tags</label> <br>
    @foreach($tags as $tag)
      <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
       {{ $tag->name }} <br> 
      <!-- tag[] za to sto je u pitanju niz svi id tagova koji su cekirani  -->
    @endforeach
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection