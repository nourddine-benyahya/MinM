<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = auth()->user()->id;
        $message = Message::with(['file','byuser','touser'])->where('by_user_id', $userId)->get();
   

    
        return Inertia::render('Messages/Allmessage', [
            'message' => $message,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Messages/Addmessage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,string $id)
    {


        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'body',
            'file',
        ]);

        $file = $request->file('file');

        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $fileName);
         
        $file = new File();
        $file->message_text = $request->body;
        $file->message_file = '/uploads/'.$fileName;
        $file->save();



        $message = new Message();
        $message->by_user_id = auth()->user()->id;
        $message->to_user_id = $id;

        $message->file_id = $file->id;
        $message->save();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $MessageId)
    {
        $message = Message::findOrFail($MessageId);
        $message->delete();
    }
}
