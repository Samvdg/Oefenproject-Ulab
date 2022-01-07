<?php

namespace App\Http\Controllers\review;

use App\Models\review\Topics;
use Illuminate\Http\Request;

class TopicsController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('review.topics', [
            "topics" => Topics::paginate(25),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required",
        ]);

        $topic = new Topics();
        $topic->fill($validatedData);
        $topic->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return redirect("review/comments?topic_id=$id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        return view('review.show_topic', [
            'topic' => Topics::findOrFail($id),
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => "required",
        ]);

        Topics::where('id',$id)->update(['name' => $validatedData["name"]]);
        return redirect('review/topics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        Topics::where('id', $id)->delete();
        return redirect('review/topics');
    }
}
