<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;  //ova 4 reda smo usovali
use App\Post;
use Illuminate\Support\Facades\Mail; 
use App\Mail\CommentReceived;

class MailTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

//testiramo da li je mejl poslat nakon komentarisanja posta
     public function testCommentReceivedValid()  //test ime klase koju testiramo i da li je validan invalidan je na primer kad nesto ne postoji
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]);

       // dd($post);

        Mail::fake();  //napravice nam lazni mejl i to je mokovanje

       $this->actingAs($user)->post( '/posts/' . $post->id . '/comments', 
            ['text' => 'this is some text add more',  //text mora imati minimum 15 karaktera
             'author' => 'somename']  //a author ne sme imati razmake 
             //gledati validaciona pravila iz modela kada proveravamo ovim testovima
        );

        Mail::assertSent(CommentReceived::class, function($mail) use ($post){
            return $mail->post->id === $post->id;
        });

        //prvi parametar prima klasu comment recieverd a drugi callback funkcija sta zelimo da proverimo
        //da li nam je post id isti kao onaj koji  naveli  a taj post nam je isti kao onaj koji smo prosledili u klasu 
    }

    //testiramo kada nije validan mejl
    public function testCommentReceivedInvalid()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]);

        Mail::fake();

        $this->post('/posts' . $post->id . '/comments', //pisemo sve isto samo izbacimo nesto da ne bude validan mejl
        ['text' => 'this is some text add more', 
          'author' => 'somename']
        );

        Mail::assertNotSent(CommentReceived::class, function($mail) use ($post){
            return $mail->post->id === $post->id;
        });
    }
}
