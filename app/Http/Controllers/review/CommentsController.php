<?php

namespace App\Http\Controllers\review;

use App\Http\Controllers\Controller;
use App\Models\review\Comments;
use Illuminate\Http\Request;
use function back;
use function view;

class CommentsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        return view('review.comments.comments' ,[
            'comments' => Comments::paginate(3),
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

        $post = new Comments();
        $post->fill($validatedData);
        $post->save();

        return back();
    }
}
