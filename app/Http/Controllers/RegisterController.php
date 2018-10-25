<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
   public function create()
   {
       return view('register.create');
   }

   public function store()
   {
        $this->validate(  
        request(),      
        User::VALIDATION_RULES
    );
    
        $user = User::create(request()->all());
        auth()->login($user); //ova linija ce nas ulogovati u aplikaciju i tu ne mozemo niz jer niz ne moze da se autentikuje

        return redirect('/posts');
   }
}
