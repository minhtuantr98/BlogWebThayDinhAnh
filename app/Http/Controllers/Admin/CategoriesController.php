<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\User;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Exceptions\ModelCouldNotDeletedException;

class CategoriesController extends Controller
{
    public function index()
    {
        if(!isset($_GET["name"])) {
            $_GET["name"] = "";
        }
        $categories = Category::where("name", 'like', '%' . $_GET["name"]. '%')->paginate(5);
        $users = User::all();
        return view('admin.categories.index', compact('categories', 'users'));
    }

    // public function listting() 
    // {
    //     return CategoryTranslation::where('locale', 'en')->orderBy('id', 'desc')->paginate(3);
    // }

    public function edit($id)   
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id.''
        ]);

        Category::find($id)
            ->fill([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ])
            ->save();
        
        return redirect('admin/category')->with('success', ['Edit Success']);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name'
        ]);
        
        Category::forceCreate([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'user_id' => Auth::user()->id
        ]);

        return redirect('admin/category')->with('success', ['Create Success']);
    }
    
    public function destroy($id)
    {   
        try {
            Category::findOrFail($id)->delete();
        } catch (ModelCouldNotDeletedException $exception) {
            return redirect('admin/category')->with('error', ['U cant delete it !!!']);
        }

        return redirect('admin/category')->with('success', ['Delete Success']);
    }
}
