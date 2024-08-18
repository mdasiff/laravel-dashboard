<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Helpers\AdminHelper;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speakers = Speaker::get();

        return view('admin.speaker.index',['speakers'=>$speakers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.speaker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'   => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:2048';
        }

        $request->validate($rules);

        $slug = \Str::slug($request->name);

        $data = [
            'name'=>$request->name,
            'image_alt'=>$request->image_alt,
            'email'=>$request->email,
            'designation'=>$request->designation
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $data['image'] = AdminHelper::upload_image($request, $slug, 'speaker');
        }

        Speaker::create($data);

        return redirect()->route('admin.speaker.index')->with('success', 'Speaker created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speaker $speaker)
    {
        return view('admin.speaker.edit', ['speaker'=>$speaker]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speaker $speaker)
    {
        $rules = [
            'name'   => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:2048';
        }

        $request->validate($rules);

        $slug = \Str::slug($request->name);

        $data = [
            'name'=>$request->name,
            'image_alt'=>$request->image_alt,
            'email'=>$request->email,
            'designation'=>$request->designation
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $data['image'] = AdminHelper::upload_image($request, $slug, 'speaker');
        }

        $speaker->update($data);

        return redirect()->route('admin.speaker.index')->with('success', 'Speaker updated successfully');
    }

    
}
