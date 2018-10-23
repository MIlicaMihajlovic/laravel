<?php

namespace App;

use App\Post; //uzima iz posta
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id']; // polja koja ne mozes da menjamo a fillable polja koja mozes da menjas

    public function post()
    {
        return $this->belongsTo(Post::class);  //jedan komentar pripada jednom postu
    }
}
