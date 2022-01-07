<?php

namespace App\Http\Controllers\User;


class UserController
{
    public function login()
    {

        return view('user.login.twig');
    }
}
