<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\review\Comments;
use App\Models\review\Topics;
use App\Models\user\User;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    public function index()
    {
        if(Auth::check()){
            return view('user.profile', [
                'user' => Auth::user(),
                'topics' => Topics::where('user_id', Auth::id())->paginate(3),
                'comments' => Comments::where('user_id', Auth::id())->paginate(3),
            ]);
        } else {
            return redirect('/user/login');
        }
    }

//    public function store()
}
