<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;

class PostsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexValid()   //test onda naziv metode i sta testiramo
    {
        $response = $this->get('/posts'); //this je od test case get nam je http request na rutu na koju mi prosledjujemo
        $response->assertStatus(200);  //asert proverava da li je status ovog response dobar a 200
    }

    public function testCreateValid()
    {
        $user = factory(User::class)->create();  //kreirali smo usera jer nam je za create rutu potreban ulogovan usera
        
        $response = $this->actingAs($user)->get('/posts/create'); //actingAs nam se ponasa kao taj user koga smo kreirali

        $response->assertStatus(200);
    }

    public function testCreateInvalid()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(302); //pogodi ovu rutu bez usera i daj 302
    }

    public function testShowValid()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]);

        $response = $this->actingAs($user)->get('/posts/' . $post->id);  //ovde pisemo rutu kako inace izgleda
        $response->assertStatus(200); //ovde smo acting 
    }

    public function testShowInvalid()
    {
        $user = factory(User::class)->create();  //kreiramo usera
        $post = factory(Post::class)->create(['author_id' => $user->id]); //kreiramo post
        
        $response = $this->get('/posts/' . $post->id); //ali ovde ne povezujemo usera i post
        $response->assertStatus(302); //zato i saljemo na gresku jer post i usera nismo povezali
    }
}
