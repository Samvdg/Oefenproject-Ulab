<?php

namespace App\Http\Controllers\review;

use App\Models\review\Comments;
use App\Models\review\Topics;
use App\Models\user\User;
use Illuminate\Http\Request;
use function back;
use function view;

class CommentsController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        $topic = Topics::findOrFail(request("topic_id"), ['id', 'name', 'user_id', 'created_at']);
        $comments = Comments::where('topic_id', $topic->id)->paginate(3);
        return view("review.comments" ,[
            "comments" => $comments,
            "topic" => $topic,
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
            "title" => "required|max:100|min:5",
            "description" => "required|min:1|max:100",
            "vote" => "required|integer|min:1|max:5",
            "user_id" => "required|integer",
            "topic_id" => "required|integer",
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

}
