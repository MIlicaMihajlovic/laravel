<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //da nam ne bi kreirao previse onda ga ogranicavamo nizom value
    {
        $values = [
            'Blogging',
            'Freelancing',
            'How to Succeed'
        ];
        App\Tag::truncate(); //obrisace nam sve iz tabele do sada

        foreach ($values as $value){              //ovo nam prolazi kroz niz za svaki clan ovog niza da nam napravi jedan tag
            App\Tag::create([
                'name' => $value
            ]);
        }

        App\Post::all()->each(function(App\Post $post){ //select nam bira id a take 2 samo 2 random
            $randIds = \App\Tag::inRandomOrder()->select('id')->take(2)->pluck('id');

            $post->tags()->attach($randIds); //za svaki post mi zakaci random tag
        });
        //pluck pravi niz od id-a 
    }
}
