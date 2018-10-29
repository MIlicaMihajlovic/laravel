<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('age', ['only' => 'store']);  //ime iz kernel-a primenice samo na store ovaj middleware   
    }

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


    $user = new User();
    $user->name = request('name');
    $user->email = request('email');
    $user->password = bcrypt(request('password'));
    $user->save(); // da bi sacuvali usera u bazi
    
        //$user = User::create(request()->all());
        auth()->login($user); //ova linija ce nas ulogovati u aplikaciju i tu ne mozemo niz jer niz ne moze da se autentikuje
        session()->flash('message', 'Hvala sto ste se registrovali!'); //ovo je 29.0ktobar php session varijabla je niz
                                                                        //flash je kratkotrajna poruka moze sucess, warning. flash  jos nesto
        return redirect('/posts');
   }
}
