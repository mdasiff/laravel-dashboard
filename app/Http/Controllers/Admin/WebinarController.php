<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Speaker, Webinar, Timezone, WebinarUser};

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::latest()->paginate(100);

        return view('admin.webinar.index',['webinars'=>$webinars]);
    }

    public function create()
    {   
        $speakers = Speaker::get();
        $timezones = Timezone::get();
        return view('admin.webinar.create', compact('speakers', 'timezones'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title'   => 'required',
        ];

        $request->validate($rules);

        $data = [
            'speaker_id' => $request->speaker,
            'title'=>$request->title,
            'slug' => \Str::slug($request->title),
            'industry'=>$request->industry,
            'webinar_date'=>$request->webinar_date,
            'global_zone'=>implode(',',$request->global_zone),
            'timezone_id'=>$request->timezone,
            'synopsis'=>$request->synopsis,
            'youtube'=>$request->youtube,
            'status'=>$request->status,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
            'meta_tag_description'=>$request->meta_tag_description,
        ];

        Webinar::create($data);

        return redirect()->route('admin.webinar.index')->with('success', 'Webinar created successfully');
    }

    public function edit(Webinar $webinar)
    {
        //return date('Y-m-d h:m a', strtotime($webinar->webinar_date));
        $speakers = Speaker::get();
        $timezones = Timezone::get();
        return view('admin.webinar.update', compact('webinar', 'speakers', 'timezones'));
    }

    public function update(Request $request, Webinar $webinar)
    {
        $rules = [
            'title'   => 'required',
            'synopsis' => 'required',
            'industry' => 'required' 
        ];

        $request->validate($rules);

        $data = [
            'speaker_id' => $request->speaker,
            'title'=>$request->title,
            'slug' => \Str::slug($request->title),
            'industry'=>$request->industry,
            'webinar_date'=>$request->webinar_date,
            'global_zone'=>implode(',',$request->global_zone),
            'timezone_id'=>$request->timezone,
            'synopsis'=>$request->synopsis,
            'youtube'=>$request->youtube,
            'status'=>$request->status,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_keywords'=>$request->meta_tag_keyword,
            'meta_tag_description'=>$request->meta_tag_description,
        ];

        $webinar->update($data);
        return redirect()->route('admin.webinar.index')->with('success', 'Webinar updated successfully');
    }

    public function users()
    {
        $users = WebinarUser::latest()->get();
        return view('admin.webinar.users',['users'=>$users]);
    }

}
