<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        
        $comments = DB::table('comments')
                    ->join('users', 'users.id', '=', 'comments.user_id')
                    ->orderBy('comments.created_at', 'desc')
                    ->select('users.name', 'comments.*')
                    ->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy($id)
    {   
        Comment::findOrFail($id)->delete();
        return redirect('/admin/comment')->with('success', ['Delete Success']);
    }
}
