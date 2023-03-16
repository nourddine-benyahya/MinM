<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = Message::with(['users','files'])
        ->join('users', 'users.id', '=', 'message.by_user_id')
        ->join('users','users.id','=','message.to_user_id')
        ->join('files','files.id','=','message.file_id')
        ->select('files.message_text','files.message_file','users.firstname','users.lastname','messages.*')
        ->get();

    
        return Inertia::render('Messages/AllMessage', [
            'posts' => $message,
        ]);
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
     */
    public function store(Request $request)
    {
        //
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
