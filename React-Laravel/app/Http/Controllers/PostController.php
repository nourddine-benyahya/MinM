<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {

        $posts = Post::with(['comments', 'likes'])
        ->join('files', 'files.id', '=', 'posts.file_id')
        ->join('users','users.id','=','posts.user_id')
        ->select('files.message_text','files.message_file','users.*','posts.*')
        ->get();

    


       
        return Inertia::render('Post/Allpost', [
            'posts' => $posts,
        ]);
    }
 /**
     * my posts.
     */

     public function myPosts()
     {
         $user = auth()->user();
         $posts = $user->posts()->with(['comments', 'likes'])->get();
         return Inertia::render('Post/Myposts', [
             'posts' => $posts,
         ]);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Post/AddPost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
    
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->file_id = 1; // Replace with the actual ID of the file
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();
    
        return redirect(RouteServiceProvider::POST);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Post::with(['comments','likes'])->find($id);
        return Inertia::render('Post/detailpost', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return Inertia::render('Post/Edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect()->route('posts.show', ['id' => $post->id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect(RouteServiceProvider::POST);
    }
}
