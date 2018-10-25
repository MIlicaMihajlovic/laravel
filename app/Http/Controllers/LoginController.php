<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function logout()
    {
        auth()->logout(); //ovo ce nam izlogovati userea

        return redirect('/posts');
    }

    // public function login()
    // {
    //     auth()->login();

    //     return redirect('/posts');
    // }
}
