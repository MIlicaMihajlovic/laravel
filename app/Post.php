<?php

namespace App;

use App\User;
use App\Comment; //i ovde moramo da ih povezemo
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    

    protected $guarded = ['id'];
    

    const VALIDATION_RULES =
    [
        'title' => 'required',    //validacija na bekendu
        'body' => 'required | min:25', // prava crta | nam pomaze da dodamo jos neki uslov
        'published' => 'required',
        'tags' => 'required|array' //cim imamo [] zagrade moramo da pisemo i array
    ];

    public static function getPublishedPosts()
    {
        return Post::where('published', true); //hocemo da vratimo samo one postove koji su publishovani
        //on klasu post veze za tabelu post jer je pametan
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); //dodajemo author id da bi znao preko koje kolone da poveze
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); //jedan post ima vise komentara
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);    //u istom su namespace i onda se ne mora use Tag gore
    }
}
