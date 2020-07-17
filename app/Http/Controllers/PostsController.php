<?php

namespace App\Http\Controllers;

use DB;
use App\Post ;
use App\Category;
use App\User;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{   
    public function listByCategory($slug)   
    {
        session()->forget('pages');
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts =  Post::where('category_id', $category->id)->where('active',1)->get();
        
        return view('post_category', compact("posts", "category"));
    }

}
