<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function index()
    {
        return Auth::check() ?  view('user.profile') : view('user.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|min:5|max:100",
            "username" => "required|min:2|max:100",
            "email" => "required|email|max:100",
            "password" => "",
            "password_confirmation" => "",
        ]);
    }
}
