<?php

namespace App\Http\Controllers\User;

use Auth;
use App\User;
use App\Rules\OldPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Exceptions\ModelCouldNotDeletedException;

class InfoController extends Controller
{
  
    public function edit($id)   
    {
        return view('user.info.edit', compact("id"));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            'email' => 'required|unique:users,email,'.Auth::user()->id.'',
        ]);

        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $request->file->storeAs('public/upload', $filename);
        } else {
            $filename = $request->file_old;
        }
        
        Auth::user()
            ->fill([
                'name' => $request->name,
                'email' => $request->email,
                'description' => $request->description,
                'image' => $filename
            ])
            ->save();
        
        return redirect()->back()->with('success', ['Edit Success']);
    }

    public function getPassword() {
        return view('user.info.changepassword');
    }

    public function updatePassword(Request $request) {

        $this->validate($request, [
            'old_password' => ['required', 'string'],
            'password' => 'required|min:8|confirmed',
        ]);

        if(Hash::check($request->old_password,Auth::user()->password) == true){
        Auth::user()
            ->fill([
                'password' => Hash::make($request->password),
            ])
            ->save();

            return redirect()->back()->with('success', 'Change success');
        } else {
            return redirect()->back()->with('success', 'Old password not right');
        }
    }
}
