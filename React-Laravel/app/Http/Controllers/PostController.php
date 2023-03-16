<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{   
    /*
    *Display a listing of the resource.
    */
    public function index()
    
    {

        $posts = Post::with(['comments', 'likes'])
        ->join('files', 'files.id', '=', 'posts.file_id')
        ->join('users','users.id','=','posts.user_id')
        ->select('files.message_text','files.message_file','users.username','users.firstname','users.lastname','posts.*')
        ->get();

    


       
        return Inertia::render('Post/Allpost', [
            'posts' => $posts,
        ]);
    }
    /*
    *my posts.
    */

     public function myPosts()
     {
        $user = auth()->user();
        $posts = $user->posts()->with(['comments', 'likes'])->get();
        return Inertia::render('Post/Myposts', [
            'posts' => $posts,
        ]);
     }

    /*
    *Show the form for creating a new resource.
    */
    public function create()
    {
        return Inertia::render('Post/AddPost');
    }
    /*
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'file',
        ]);

       /* $file = $request->file('file');

        $filename = uniqid().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs('uploads', $file, $filename);
         */
        $file = new File();
        $file->message_text = $request->body;
        $file->message_file = $request->file;
        $file->save();
       

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->file_id = $file->id;
        $post->save();
    
        return redirect(RouteServiceProvider::POST);
    }

    /*
    * Display the specified resource.
    */
    public function show(string $id)
    {
        $posts = Post::with(['comments','likes'])->find($id);
        return Inertia::render('Post/detailpost', [
            'posts' => $posts,
        ]);
    }

    /*
    * Show the form for editing the specified resource.
    */
    public function edit(string $id)
    {      
        $post = Post::findOrFail($id);

        if(auth()->user()->id==$post->user_id){

            $file= File::findOrFail($post->file_id);
        
            return Inertia::render('Post/EditPost', [
                'post' => $post,
                'file'=> $file
            ]);
        }else{
            return "not found";
        }
    }

    /*
    * Update the specified resource in storage.
    */
    public function update(Request $request,  $id)
    {

        return ($id);
    }
/*
        $post = Post::findOrFail($id);

        if(auth()->user()->id==$post->user_id){

        $file= File::findOrFail($post->file_id);
        $file->update($request->all());
        return redirect(RouteServiceProvider::POST);
        }else{
            return "not found";
        }
    }


    
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        $post->delete();
        return redirect(RouteServiceProvider::POST);
    }
}
