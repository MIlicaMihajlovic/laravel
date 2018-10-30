<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class);    //u istom su namespace i onda se ne mora use Post gore
    }

    public function getRouteKeyName() //ova metoda je na elokvent modelu i mi smo je overridovali
    {
        return 'name'; //preko kolone koju mi zelimo povezujemo rutu sa kontrolerom
    }
}
