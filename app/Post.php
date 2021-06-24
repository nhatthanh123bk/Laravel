<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];
   
    public function category(){
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function comment()
    {
        return $this->morphMany('App\Comment', 'post');
    }
}
