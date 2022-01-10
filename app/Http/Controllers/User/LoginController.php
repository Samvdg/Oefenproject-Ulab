<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;

class LoginController
{
    public function index()
    {

        return view('user.login');
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
