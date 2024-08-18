<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Blog, BlogPost};
use App\Helpers\AdminHelper;

class BlogPostController extends Controller
{
    public function index(Blog $blog) {
        
        $posts = BlogPost::where('blog_id', '=', $blog->id)->get();
        return view('admin.blog-post.index', compact('posts', 'blog'));
        
    }

    public function create(Blog $blog) {
        return view('admin.blog-post.create', compact('blog'));
    }

    public function store(Request $request, Blog $blog)
    {
        
            $validated = $request->validate([
                'post' => 'required',
                'sort' => 'required',
                'status' => 'required'
            ]);  
    
            $data = [
                'blog_id' => $blog->id,
                'heading' => $request->heading,
                'image_alt' => $request->image_alt,
                'post' => $request->post,
                'sort' => $request->sort,
                'status' => $request->status==1?1:0,
            ];
    
            if($request->has('image'))
            {
                $data['image'] = AdminHelper::upload_image($request, null, 'blogs');
            }
    
            BlogPost::create($data);
    
            return redirect()->route('admin.blogpost.index', $blog->id)->with('success','Blog Post created successfully.');
        
       
    }

    public function edit(Blog $blog, BlogPost $post) {
            return view('admin.blog-post.update', compact('post', 'blog'));
        
    }

    public function update(Blog $blog, BlogPost $post, Request $request)
    {
        $validated = $request->validate([
            // 'heading' => 'required',
            'post' => 'required',
            'sort' => 'required',
            'status' => 'required'
        ]);  

        $data = [
            'heading' => $request->heading,
            'image_alt' => $request->image_alt,
            'post' => $request->post,
            'sort' => $request->sort,
            'status' => $request->status==1?1:0,
        ];

        if($request->has('image'))
        {
            $data['image'] = AdminHelper::upload_image($request, null, 'blogs');
        }

        $post->update($data);
        return redirect()->route('admin.blogpost.index', $blog->id)->with('success','Blog Post updated successfully.');
        
    }

    public function status_update(BlogPost $post) {
        if($post->status == 1) {
            $post->status = 0;
        } else {
            $post->status = 1;
        }
        $post->save();
        return back()->with('success','Blog Post status updated successfully.');
    }

    public function delete(BlogPost $post) {
        $post->delete();
        return back()->with('success','Blog Post deleted successfully.');
    }
}
