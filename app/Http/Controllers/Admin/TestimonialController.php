<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial.index',compact('testimonials'));
    }

    public function create()
    {   
        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'location' => 'required',
            'message' => 'required',
            'sort' => 'required',
            'status' => 'required'
        ];


        $validated = $request->validate($rules);  

        $data = [
            'name' => $request->name,
            'video' => $request->video,
            'type' => 'text',
            'location' => $request->location,
            'image_alt' => $request->image_alt,
            'message' => $request->message,
            'sort' => $request->sort,
            'status' => $request->status==1?1:0,
            'show_on_home_page' => $request->show_on_home_page==1?1:0,
        ];

        

        if($request->has('image'))
        {
            
            $image = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/testimonials'), $image);
            $data['image'] = $image;
        }


        $testimonial = Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success','Testimonial created successfully.');
        
        
    }

    public function edit(Testimonial $testimonial) {
        return view('admin.testimonial.update', compact('testimonial'));
    }

    public function update(Testimonial $testimonial, Request $request)
    {
        $rules = [
            'name' => 'required',
            'location' => 'required',
            'message' => 'required',
            'sort' => 'required',
            'status' => 'required'
        ];

        $validated = $request->validate($rules);  

        $data = [
            'name' => $request->name,
            'video' => $request->video,
            'type' => 'text',
            'location' => $request->location,
            'image_alt' => $request->image_alt,
            'message' => $request->message,
            'sort' => $request->sort,
            'status' => $request->status==1?1:0,
            'show_on_home_page' => $request->show_on_home_page==1?1:0,
        ];


        if($request->has('image'))
        {
            
            $image = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/testimonials'), $image);
            $data['image'] = $image;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success','Testimonial updated successfully.');
        
    }

    public function status_update(Testimonial $testimonial) {
        if($testimonial->status == 1) {
            $testimonial->status = 0;
        } else {
            $testimonial->status = 1;
        }
        $testimonial->save();
        return back()->with('success','Testimonial status updated successfully.');
    }

    public function delete(Testimonial $testimonial) {
        $testimonial->delete();
        return back()->with('success','Testimonial deleted successfully.');
    }

}
