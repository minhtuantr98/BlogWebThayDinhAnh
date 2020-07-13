<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Exceptions\ModelCouldNotDeletedException;

class UsersController extends Controller
{
    public function index()
    {
        if(!isset($_GET["name"])) {
            $_GET["name"] = "";
        }
        $users = User::where("name", 'like', '%' . $_GET["name"]. '%')->paginate(5);

        return view('admin.users.index', compact('users'));
    }
  
    public function edit($id)   
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            'email' => 'required|unique:users,email,'.$id.'',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::find($id)
            ->fill([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->is_admin
            ])
            ->save();
        
        return redirect('admin/user')->with('success', ['Edit Success']);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        User::forceCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin
        ]);

        return redirect('admin/user')->with('success', ['Create Success']);
    }
    
    public function destroy($id)
    {   
        try {
            Users::findOrFail($id)->delete();
        } catch (ModelCouldNotDeletedException $exception) {
            return redirect('admin/user')->with('error', ['U cant delete it !!!']);
        }

        return redirect('admin/user')->with('success', ['Delete Success']);
    }
}
