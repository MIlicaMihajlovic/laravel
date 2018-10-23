<?php

namespace App;

use App\Comment; //i ovde moramo da ih povezemo
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    

    protected $fillable = [
        'title', 'body', 'published'
    ];

    const VALIDATION_RULES =
    [
        'title' => 'required',    //validacija na bekendu
        'body' => 'required | min:25', // prava crta | nam pomaze da dodamo jos neki uslov
        'published' => 'required'
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
