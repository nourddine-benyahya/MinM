<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , string $id)
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $id;
        $comment->body = $request->body;
        $comment->save();
    
        return redirect(RouteServiceProvider::POST);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment= Comment::findOrFail($id);
        $comment->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */



    public function destroy(String $CommentId)
    {
        $comment = Comment::findOrFail($CommentId);
        $comment->delete();
    }
}
