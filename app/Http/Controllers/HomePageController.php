<?php

namespace App\Http\Controllers;

use App\Email;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function showContact() {
        Session::put('pages', 1);
        return view('contact');
    }

    public function showAbout() {
        Session::put('pages', 1);
        return view('about');
    }

    public function addEmail(REQUEST $request) {
        Email::forceCreate([
            'email' => $request->email,
        ]);
        return redirect('/home')->with('success', ['Add Mail Subcribe Success']);
    }
}
