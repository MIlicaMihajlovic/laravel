<?php

namespace App;

use App\Comment; //i ovde moramo da ih povezemo
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    

    protected $fillable = [
        'title', 'body', 'published'
    ];

    public static function getPublishedPosts()
    {
        return Post::where('published', true)->get(); //hocemo da vratimo samo one postove koji su publishovani
        //on klasu post veze za tabelu post jer je pametan
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); //jedan post ima vise komentara
    }
}
