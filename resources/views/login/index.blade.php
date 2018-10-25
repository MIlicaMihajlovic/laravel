@extends('layouts.master')

@section('title')
    Login User
@endsection


@section('content')

    <h2>Login User</h2>

<form method="POST" action="/login">
 

 {{ csrf_field() }}

 
<div class="form-group">

<label>Email</label>
<input name="email" type="text" class="form-control" placeholder="Enter email">
@include('layouts.partials.error-message', ['field' => 'email'])  
</div>

 <div class="form-group">

<label>Password</label>
<input name="password" type="password" class="form-control" placeholder="Enter password">
@include('layouts.partials.error-message', ['field' => 'password'])  
</div>


<button type="submit" class="btn btn-primary">Submit</button>
</form>
<!-- ako ima gresaka izbaci ovu poruku you shall not pass -->
    @if(count($errors->all()))                  
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

@endsection    