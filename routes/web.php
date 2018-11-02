<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', 'LoginController@logout');

Route::prefix('/login')->group(function(){
    Route::get('/', 'LoginController@index')->name('login');
    Route::post('/', 'LoginController@login');
});



Route::prefix('/register')->group(function()
{
    Route::get('/', 'RegisterController@create'); //za forme do registracije
    Route::post('/', 'RegisterController@store'); //za osposobljavanje registracije
});

Route::get('/posts', 'PostsController@index');
Route::group(['prefix' => 'posts', 'middleware' => ['auth']], function (){   //grupna funkcija kako ne bismo stalno pisali posts i skratili
    
    Route::get('/create', 'PostsController@create'); //za kreiranje postova i to mora prvo jer ako je id onda i create prepoznaje kao id
    Route::post('/', 'PostsController@store');
    
    Route::get('/{id}', 'PostsController@show'); //bitan je redosled 

    

    
    
    
    Route::prefix('/{postId}/comments')->group(function(){

        Route::post('/', 'CommentsController@store'); //za kreiranje komentara
        Route::post('/{commentId}', 'CommentsController@destroy');
    });
    
    
    
});

Route::get('/users/{id}', 'UsersController@show'); ///ruta za jednog usera svi postovi

Route::get('/posts/tags/{tag}', 'TagsController@index');

//prosledjujemo ceo objekat taga a ne id