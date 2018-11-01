<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {                    //a ovde da smo hteli samo na posts onda ovako ['posts.index', 'posts.show']   
        view()->composer('layouts.master', function($view){ //ovde koristimo layouts.master jer nam je on svuda ekstendovan i svuda nam je vidljiv svuda
             //prvi parametar je view a dgugi niz je callback funkcija
            $tags = Tag::has('posts')->get();  //posts je relacija
            //vrati mi tag koji je na nekom postu
            //has nam proverava da li ima relaciju i ako ima onda mi daj sve koje ima

            $view->with('tags', $tags);
            //view prosledjujemo te tagove
         });
       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
