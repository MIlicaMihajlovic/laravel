<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;
use App\Comment;
use App\Tag;

class DatabaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostsTableValid()   //testiramo nakon sto je kreiran post da li je stvarno u bazi
    {                                           //testiramo samo post
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]); //a ovde smo kreirali taj post

        $this->assertDatabaseHas('posts', [
            'title' => $post->title, //da li ima post sa tim naslovom u bazi 
        ]);
    }

    public function testCommentsTableValid()  //testiramo da li ima komentara u bazi ka se kreiraju
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]);

        $post->comments()->saveMany(factory(
            Comment::class, 10   //kreiramo vise komentara a koristimo make zato sto smo kreirali vise komentara
        )->make());     //saveMany da sacuvamo vise komentara

        $this->assertEquals(10, $post->comments()->count()); //ovde proveravamo da li je napravilo 10 komentara
    }

        //kad kreiramo tagove da li su oni stvarno upisani u bazu i na postu
    public function testTagsOnPostsTableValid()
    {
        $user = factory(User::class)->create(); //kreirali smo usera
        $post = factory(Post::class)->create(['author_id' => $user->id]); //kreirali smo post
        
        
        $post->tags()->saveMany(factory(
            Tag::class, 10)
            ->make());  //kreiramo 10 tagova pomocu factory, gledati u TagFactory.php zbog imena tabele

        $this->assertEquals(10, $post->tags()->count());  //prebrojavamo tih 10 tagova da li su kreirani i uneti u bazu   

    }

    public function testTagsTableValid() //da li mi je kreiran tag u tabeli sa tim imenom
    {
        $tag = factory(Tag::class)->create(); //kreiramo jedan tag

        $this->assertDatabaseHas('tags', ['name' => $tag->name]); //da li je tag sa tim imenom kreiran u bazi
    }
}
