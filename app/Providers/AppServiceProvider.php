<?php

namespace App\Providers;


use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = DB::table('categories')
                    ->join("posts", 'categories.id', '=', 'posts.category_id')
                    ->select( DB::raw('count(posts.id) as cat_count, categories.name, categories.slug'))
                    ->where("posts.active",1)
                    ->groupBy('categories.name', 'categories.slug')
                    ->get();
        $popularPosts =  DB::table('posts') 
          ->join('comments', 'posts.id', '=', 'comments.post_id')
          ->join('users', 'users.id', '=', 'posts.user_id')
          ->select( DB::raw('count(comments.id) as cat_count, posts.title, posts.slug, posts.published_at, posts.description, users.name, posts.image'))
          ->where("posts.active",1)
          ->orderBy("cat_count", 'desc')
          ->groupBy('posts.title', 'posts.slug' , 'posts.published_at', 'posts.description', 'users.name', 'posts.image')
          ->paginate(3);
        View::share('categories', $categories);
        View::share('popularPosts', $popularPosts);
    }
}
