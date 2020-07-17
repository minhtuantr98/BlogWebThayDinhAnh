<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Auth;
use App\User;
use App\Post;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
  public function getListPost() {
    Session::forget('pages');
    return DB::table('posts') 
          ->join('comments', 'posts.id', '=', 'comments.post_id')
          ->select( DB::raw('count(comments.id) as cat_count, posts.title, posts.slug, posts.published_at, posts.description, posts.image'))
          ->where("posts.active",1)
          ->where("posts.published_at", '<=', Carbon::now()->toDateString('Y-m-d'))
          ->groupBy('posts.title', 'posts.slug' , 'posts.published_at', 'posts.description', 'posts.image')
          ->paginate(1);
  }

  public function getPostDetail($slug) {
    Session::forget('pages');
    $post = Post::where('slug', $slug)->firstOrFail();
    $comments = DB::table('users')
               ->join('comments', 'users.id', '=', 'comments.user_id')
               ->where('comments.post_id', $post->id)
               ->orderBy('id', 'desc')
               ->select('comments.*', 'users.name', 'users.image', 'users.is_admin')
               ->get();
   $totalComment =  DB::table('users')
               ->join('comments', 'users.id', '=', 'comments.user_id')
               ->join('posts', 'posts.id', '=', 'comments.post_id')
               ->where('posts.id', '=', $post->id)
               ->select('comments.*', 'users.name')
               ->get()->count();
    $user = User::find($post->user_id);
    return view('post_detail', compact("post", "comments", "totalComment", "user"));
 }

 public function searchPost(REQUEST $request) 
 {
  Session::forget('pages');
     return DB::table('posts') 
          ->join('comments', 'posts.id', '=', 'comments.post_id')
          ->select( DB::raw('count(comments.id) as cat_count, posts.title, posts.slug, posts.published_at, posts.description, posts.image'))
          ->where('posts.title', 'like','%' .$request->search. '%')
          ->where("posts.active",1)
          ->groupBy('posts.title', 'posts.slug' , 'posts.published_at', 'posts.description', 'posts.image')
          ->get();
 }

 public function getListComment(REQUEST $request) 
 {
  Session::forget('pages');
   return DB::table('users')
   ->join('comments', 'users.id', '=', 'comments.user_id')
   ->join('posts', 'posts.id', '=', 'comments.post_id')
   ->where('posts.id', '=', $request->get('id'))
   ->orderBy('id', 'desc')
   ->select('comments.*', 'users.name')
   ->get();
 }

 public function addComment(REQUEST $request) 
 {
  Session::forget('pages');
   if(!Auth::check()) {
     return 1;
   }
   Comment::forceCreate([
      'user_id' => Auth::user()->id,
      'post_id' => $request->id,
      'content' => $request->content,
  ]);
  return DB::table('users')
  ->join('comments', 'users.id', '=', 'comments.user_id')
  ->join('posts', 'posts.id', '=', 'comments.post_id')
  ->where('posts.id', '=', $request->id)
  ->orderBy('id', 'desc')
  ->select('comments.*', 'users.name', 'users.image', 'users.is_admin')
  ->get();
 }

 public function deleteComment(REQUEST $request) 
 {
  Session::forget('pages');
   if(Comment::find($request->idComment)->user_id != Auth::user()->id) {
     return 1;
   }

   Comment::find($request->idComment)->delete();
  return DB::table('users')
  ->join('comments', 'users.id', '=', 'comments.user_id')
  ->join('posts', 'posts.id', '=', 'comments.post_id')
  ->where('posts.id', '=', $request->idPost)
  ->orderBy('id', 'desc')
  ->select('comments.*', 'users.name', 'users.image' ,'users.is_admin')
  ->get();
 }

 public function countComment(REQUEST $request) 
 {
  Session::forget('pages');
  return DB::table('users')
  ->join('comments', 'users.id', '=', 'comments.user_id')
  ->join('posts', 'posts.id', '=', 'comments.post_id')
  ->where('posts.id', '=', $request->id)
  ->select('comments.*', 'users.name')
  ->get()->count();
 }
}
