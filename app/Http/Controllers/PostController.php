<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {

//        $posts = Post::all();
//        dd($posts->max());
        return view('posts' ,[
            'posts' => Post::paginate(3),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException This function validates the given posts and pushes it to the database if correct
     */
    public function post(Request $request)
    {
//        return view('posts');

        $validatedData = $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|max:100',
            'title' => 'required|max:100|min:5',
            'description' => 'required|min:1|max:100',
            'vote' => 'required|min:1|max:5',
        ]);

        $post = new Post();
        $post->fill($validatedData);
        $post->save();

        return back();
    }
}
