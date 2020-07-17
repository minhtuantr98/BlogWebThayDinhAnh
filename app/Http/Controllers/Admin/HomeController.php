<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Carbon;
use App\User;
use App\Post;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::get()->count();
        $user = User::where('created_at', '<' , Carbon::now())->where('created_at', '>', Carbon::now()->subDay(1))->get()->count();
        $comment = Comment::where('created_at', '<' , Carbon::now())->where('created_at', '>', Carbon::now()->subDay(1))->get()->count();
        $post = Post::where('active', 0)->orderBy('created_at', 'desc')->get()->count();
        return view('admin.home', compact('category', 'user', 'comment', 'post'));
    }
}
