<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ModelCouldNotDeletedException;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'user_id'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongTo('App\User', 'user_id', 'id');
    }
    
    public function delete()
    {
        // if ($this->posts()->count() > 0) {
        //     throw new ModelCouldNotDeletedException;
        // }

        return parent::delete();
    }
}
