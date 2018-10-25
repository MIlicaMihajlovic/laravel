<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()                             
    {                                                       //proverava da li je korisnik gost
        $this->middleware('guest', ['except' => 'logout']); //na metodu logout ne treba primeniti middleware
    }
   
    public function index()
    {
        return view('login.index');
    }

    public function login()                                  //request 
    {
        if(!auth()->attempt(request(['email', 'password']))) { //za autentifikaciju usera email i password su po difoltu u bazi

           return back()->withErrors([
                'message' => 'You shall not pass.'
           ]); 
        }
        return redirect('/posts');
        
    }
   
   
    public function logout()
    {
        auth()->logout(); //ovo ce nam izlogovati userea

        return redirect('/posts');
    }

    
}
