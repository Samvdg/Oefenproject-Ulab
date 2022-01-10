<?php

namespace App\Http\Controllers\User;


use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function index()
    {

        return view('user.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|min:2|max:100",
            "username" => "required|min:3|max:100",
            "email" => "required|email|max:100|unique:users,email",
            "password" => "required|confirmed",
        ]);

        $user = new User();
        $user->fill($validated);
        $user->save();

        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect('user/profile');
    }
}
