<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Blog, BlogCategory};
use Validator;

class BlogsController extends Controller
{
    public function index() {
        $blogs = Blog::get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create() {
        $categories = BlogCategory::where('status', '=', 1)->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:blogs',
            'category' => 'required',
            'meta_tag_title' => 'required',
            'meta_tag_description' => 'required',
            'status' => 'required'
        ]);  

        $slug = \Str::slug($request->title);
        $data = [
            'blog_category_id' => $request->category,
            'title' => $request->title,
            'image_alt' => $request->image_alt,
            'sub_title' => $request->sub_title,
            'slug' => $slug,
            'highlight_keywords' => $request->highlight_keywords,
            'status' => $request->status==1?1:0,
            'meta_tag_title' => $request->meta_tag_title,
            'meta_tag_description' => $request->meta_tag_description,
            'listing_page_description' => $request->listing_page_description,
            
        ];

        if($request->has('image'))
        {
            // if (!file_exists(public_path('uploads/blogs'))) {
            //     mkdir(public_path('uploads/blogs'), 0777, true);
            // }
            $image = $slug.'-'.time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/blogs'), $image);
            $data['image'] = $image;
        }

        $blog = Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success','Blog created successfully.');
    }

    public function edit(Blog $blog) {
        $categories = BlogCategory::where('status', '=', 1)->get();
        return view('admin.blogs.update', compact('blog', 'categories'));
    }

    public function update(Blog $blog, Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|max:200|unique:blogs,title,'.$blog->id,
            'category' => 'required',
            'meta_tag_title' => 'required',
            'meta_tag_description' => 'required',
            'status' => 'required'
        ]);  

        $slug = \Str::slug($request->title);
        $data = [
            'blog_category_id' => $request->category,
            'title' => $request->title,
            'image_alt' => $request->image_alt,
            'sub_title' => $request->sub_title,
            'slug' => $slug,
            'highlight_keywords' => $request->highlight_keywords,
            'status' => $request->status==1?1:0,
            'meta_tag_title' => $request->meta_tag_title,
            'meta_tag_description' => $request->meta_tag_description,
            'listing_page_description' => $request->listing_page_description,
        ];

        if($request->has('image'))
        {
            // if (!file_exists(public_path('uploads/blogs'))) {
            //     mkdir(public_path('uploads/blogs'), 0777, true);
            // }
            $image = $slug.'-'.time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/blogs'), $image);
            $data['image'] = $image;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success','Blog updated successfully.');
    }

    public function status_update(Blog $blog) {
        if($blog->status == 1) {
            $blog->status = 0;
        } else {
            $blog->status = 1;
        }
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success','Blog status updated successfully.');
    }

    public function delete(Blog $blog) {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success','Blog deleted successfully.');
    }
}
