<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Mail\Mail;
use App\Post ;
use App\Category;
use App\User;
use App\Email;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{   
    public function index()
    {
        if(!isset($_GET["title"])) {
            $_GET["title"] = "";
        }
        $posts = Post::where("title", 'like', '%' . $_GET["title"]. '%')->orderBy('active')->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        $users = User::all();
        return view('admin.posts.index', compact("posts", "categories", "users"));
    }

    public function edit($id)
    {
        $post = Post::find($id);

        $categories = Category::all();

        return view('admin.posts.edit', compact('categories', 'post'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,'.$id.'',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $request->file->storeAs('public/upload', $filename);
        } else {
            $filename = $request->file_old;
        }
        $check = Post::find($id)->is_highlight == 1 ? 0 : 1;
        Post::find($id)
        ->fill([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'description' => $request->description,
            'category_id' => $request->category,
            'image' => $filename,
            'active' => $request->active,
            'published_at' => $request->published,
            'is_highlight' => $request->is_highlight
        ])->save();;
        if ($request->is_highlight == 1 && $check == 1) {

            $details = [
                'title' => Post::find($id)->title,
                'link' => 'http://blogweb.test:8000/'.Post::find($id)->slug
            ];
            $emails = Email::get();
            foreach($emails as $item) {
            \Mail::to($item->email)->send(new Mail($details));
            }
        }
        return redirect('admin/post')->with('success', ['Edit Success']);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {        
        $this->validate($request, [
            'title' => 'required|unique:posts,title',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $request->file->storeAs('public/upload', $filename);

            Post::forceCreate([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'description' => $request->description,
            'category_id' => $request->category,
            'image' => $filename,
            'active' => 1,
            'user_id' => Auth::user()->id,
            'published_at' => $request->published,
        ]);
        }
        return redirect('admin/post')->with('success', ['Create Success']);
    }

    public function destroy($id,REQUEST $request)
    {
        Post::findOrFail($id)->delete();

        return redirect('admin/post')->with('success', ['Create Success']);
    }

}
