<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'user_id', 'post_id'
    ];
    
    public function post()
    {
        return $this->belongTo('App\Post', 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongTo('App\User', 'user_id', 'id');
    }

    public function delete()
    {   
        // if (Auth::user()->is_admin == 0 && $this->user_id != Auth::user()->id) {
        //     throw new ModelCouldNotDeletedException();
        // }

        return parent::delete();
    }
}
