<?php

namespace App;

use App\Post; //uzima iz posta
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id']; // polja koja ne mozes da menjamo a fillable polja koja mozes da menjas
    
    const VALIDATION_RULES =
        [
            'author' => 'required | max:10 | string',    //validacija na bekendu
            'text' => 'required | min:25' // prava crta | nam pomaze da dodamo jos neki uslov
        ];
    

    public function post()
    {
        return $this->belongsTo(Post::class);  //jedan komentar pripada jednom postu
    }
}
