<?php

namespace App\Http\Controllers\review;

use App\Http\Controllers\Controller;
use App\Models\review\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function back;
use function view;

class CommentsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        return view("review.comments" ,[
            "comments" => Comments::paginate(3),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException \
     *
     * This function validates the given posts and pushes it to the database if correct
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            "name" => "required|min:5|max:100",
            "email" => "required|email|max:100",
            "title" => "required|max:100|min:5",
            "description" => "required|min:1|max:100",
            "vote" => "required|min:1|max:5",
        ]);

        $comment = new Comments();
        $comment->fill($validatedData);
        $comment->save();

        return back();
    }

    public function show($id)
    {
        // TODO: ask for alternative error codes on database query fails
        return view("review.show_comment",[
            "comment" => Comments::findOrFail($id),
        ]);

    }

//    public function edit($id)
//    {
//
//    }
//
//    public function delete($id)
//    {
//
//    }

}
