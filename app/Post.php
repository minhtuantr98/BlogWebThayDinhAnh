<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ModelCouldNotDeletedException;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'description', 'category_id', 'active','user_id','published_at', 'image', 'is_highlight'
    ];
    
    public function category()
    {
        return $this->belongTo('App\Category', 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function delete()
    {   
        // if (Auth::user()->is_admin == 0 && $this->user_id != Auth::user()->id) {
        //     throw new ModelCouldNotDeletedException();
        // }

        return parent::delete();
    }
}
