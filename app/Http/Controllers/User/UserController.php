<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {

        return view('user.login.twig');
    }
}
