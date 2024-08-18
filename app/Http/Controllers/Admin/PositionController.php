<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Position, Candidate};

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::get();
        return view('admin.position.index',compact('positions'));
    }

    public function create()
    {   
        return view('admin.position.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title'   => 'required|max:200|unique:positions,title',
            'description'   => 'required',
            'location'   => 'required',
            'vacancy'   => 'required',
        ];

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'description'=>$request->description,
            'location'=>$request->location,
            'experience'=>$request->experience,
            'vacancy'=>$request->vacancy,
            'duration'=>$request->duration,
            'status'=>$request->status,
            'sort'=>$request->sort
        ];

        Position::create($data);

        return redirect()->route('admin.positions.index')->with('success', 'Position created successfully');
    }

    public function edit(Position $position)
    {
        return view('admin.position.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $rules = [
            'title'   => 'required|max:200|unique:positions,title,'.$position->id,
            'description'   => 'required',
            'location'   => 'required',
            'vacancy'   => 'required',
        ];

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'description'=>$request->description,
            'location'=>$request->location,
            'vacancy'=>$request->vacancy,
            'experience'=>$request->experience,
            'duration'=>$request->duration,
            'status'=>$request->status,
            'sort'=>$request->sort,
        ];

        $position->update($data);
        return redirect()->route('admin.positions.index')->with('success', 'Position updated successfully');
    }

    public function status_update(Position $position) {
        if($position->status == 1) {
            $position->status = 0;
        } else {
            $position->status = 1;
        }
        $position->save();
        return back()->with('success','Position updated successfully.');
    }

    public function delete(Position $position) {
        $position->delete();
        return back()->with('success','Position delete successfully.');
    }

}
