<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::all()->each(function(App\User $user){
            $user->posts()->saveMany(factory(App\Post::class, 5)->make());
        }); 
        //each za svakog usera prihvata callback funkciju i u njoj kao parametar pisemo model user
    }
}
