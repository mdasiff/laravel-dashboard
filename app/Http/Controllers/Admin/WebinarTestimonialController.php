<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebinarTestimonial;

class WebinarTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = WebinarTestimonial::get();
        return view('admin.webinar_testimonial.index',compact('testimonials'));
    }

    public function create()
    {   
        return view('admin.webinar_testimonial.create');
    }

    public function store(Request $request)
    {
        $rules = [
            // 'name' => 'required',
            'location' => 'required',
            'message' => 'required',
            'sort' => 'required',
            'status' => 'required'
        ];

        $validated = $request->validate($rules);  

        $data = [
            'name' => $request->name,
            'video' => $request->video,
            'image_alt' => $request->image_alt,
            'location' => $request->location,
            'message' => $request->message,
            'sort' => $request->sort,
            'status' => $request->status==1?1:0
        ];

        

        if($request->has('image'))
        {
            
            $image = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/webinar_testimonials'), $image);
            $data['image'] = $image;
        }


        $testimonial = WebinarTestimonial::create($data);

        return redirect()->route('admin.webinar_testimoni.index')->with('success','Testimonial created successfully.');
        
        
    }

    public function edit(WebinarTestimonial $testimonial) {
        return view('admin.webinar_testimonial.update', compact('testimonial'));
    }

    public function update(WebinarTestimonial $testimonial, Request $request)
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
            'location' => $request->location,
            'image_alt' => $request->image_alt,
            'message' => $request->message,
            'sort' => $request->sort,
            'status' => $request->status==1?1:0
        ];


        if($request->has('image'))
        {
            
            $image = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/webinar_testimonials'), $image);
            $data['image'] = $image;
        }

        

        $testimonial->update($data);

        return redirect()->route('admin.webinar_testimoni.index')->with('success','Testimonial updated successfully.');
        
    }

    public function status_update(WebinarTestimonial $testimonial) {
        if($testimonial->status == 1) {
            $testimonial->status = 0;
        } else {
            $testimonial->status = 1;
        }
        $testimonial->save();
        return back()->with('success','Testimonial status updated successfully.');
    }

    public function delete(WebinarTestimonial $testimonial) {
        $testimonial->delete();
        return back()->with('success','Testimonial deleted successfully.');
    }

}
