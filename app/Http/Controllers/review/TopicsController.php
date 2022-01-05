<?php

namespace App\Http\Controllers\review;

use App\Http\Controllers\Controller;
use App\Models\review\Topics;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('review.topics');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return view('review.show_topic', [
            'topic' => Topics::where('id', $id)->get(),
            'edit' => false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        return view('review.show_topic', [
            'topic' => Topics::where('id', $id)->get(),
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

//        dd($validatedData);

//        $topic = Topics::where('id',$id)->update(['name' => $])
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }
}
