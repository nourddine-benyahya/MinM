<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::with(['users','creator'])->get();


        return Inertia::render('Groups/AllGroup', [
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Groups/AddGroup');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image',
            'description' => 'required',
            'name' => 'required',
        ]);

        
        $file = $request->file('image');
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        $request->image->move(public_path('uploads'), $fileName);

        $group= new Group();
        $group->image= '/uploads/'.$fileName;;
        $group->description=$request->description;
        $group->group_name=$request->name;
        $group->group_creator=auth()->user()->id;
        $group->save();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $groups = Group::with(['users','creator'])->find($id);
        return Inertia::render('Groups/AllGroup', [
            'groups' => $groups,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $group = Group::findOrFail($id);

        if(auth()->user()->id==$group->group_creator){
        
            return Inertia::render('Post/EditPost', [
                'group' => $group,
        
            ]);
        }else{
            return "not found";
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $group = Group::findOrFail($id);
    
        if (auth()->user()->id == $group->user_id) {
          

            $validatedData = $request->validate([
                'description' => 'required',
                'name' => 'required',
            ]);


            if ($request->hasFile('image')) {



                $file = $request->file('image');
                $fileName = uniqid().'.'.$file->getClientOriginalExtension();
                $request->image->move(public_path('uploads'), $fileName);
                $group->image= '/uploads/'.$fileName;;


            }


            $group->description=$request->description;
            $group->group_name=$request->name;
            $group->save();

        } else {
            return "not found";
        }
    }


    public function Joingroup(string $id){
        $join = new GroupUser();
        $join->user_id=auth()->user()->id;
        $join->group_id=$id;
        $join->save();
    }
    public function leavegroup(string $id){
        $leave = GroupUser::findOrFail($id);

        $leave->user_id=auth()->user()->id;
        $leave->group_id=$id;
        $leave->save();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::findOrFail($id);
        if(auth()->user()->id==$group->group_creator){
            $group->delete();
        };

    }



    
}
