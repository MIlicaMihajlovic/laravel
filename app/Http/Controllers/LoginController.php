<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
   
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
