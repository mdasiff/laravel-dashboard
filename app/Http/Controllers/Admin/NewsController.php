<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{News};
use App\Helpers\AdminHelper;


class NewsController extends Controller
{
    public function index(News $news) {
        $news = News::get();
        return view('admin.news.index', compact('news'));
    }

    public function create() {
        
        return view('admin.news.create');
        
    }

    public function store(Request $request, News $news)
    {
        $rules = [
            'title' => 'required|unique:news',
            'slug' => 'required|unique:news',
            'short_description' => 'required',
            'description' => 'required',
            'sort' => 'required',
            'status' => 'required',
            'thumbnail_alt' => 'required',
            'image_mobile'=>'image|mimes:jpeg,png,jpg|max:3048'
        ];

        $validated = $request->validate($rules);  

        if($request->has('image'))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
            $rules['image_alt'] = 'required';
        }
        $slug = \Str::slug($request->slug);
        $data = [
            'title' => $request->title,
            'tag' => $request->tag,
            'slug' => $slug,
            'image_alt' => $request->image_alt,
            'thumbnail_alt' => $request->thumbnail_alt,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status,
            'sort' => $request->sort,

            'meta_tag_title' => $request->meta_tag_title,
            'meta_tag_keywords' => $request->meta_tag_keywords,
            'meta_tag_description' => $request->meta_tag_description
        ];

        if($request->has('image'))
        {
            $data['image'] = AdminHelper::upload_image($request, $slug, 'news');
        }

        if($request->has('image_mobile'))
        {
            $data['thumbnail'] = AdminHelper::upload_image_mobile($request, $slug, 'news');
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success','News created successfully.');
        
    }

    public function edit(News $news) {
        return view('admin.news.edit', compact('news'));
    }

    public function update(News $news, Request $request)
    {
        $rules = [
            'title' => 'required|unique:news,id,'.$news->id,
            'slug' => 'required|unique:news,id,'.$news->id,
            'short_description' => 'required',
            'description' => 'required',
            'sort' => 'required',
            'status' => 'required',
            // 'image_alt' => 'required',

            'thumbnail_alt' => 'required',
            //'image_mobile'=>'image|mimes:jpeg,png,jpg|max:3048'
        ];

        if($request->has('image'))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        if($request->has('image_mobile'))
        {
            $rules['image_mobile'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $validated = $request->validate($rules);  
        $slug = \Str::slug($request->slug);
        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'tag' => $request->tag,
            'image_alt' => $request->image_alt,
            'thumbnail_alt' => $request->thumbnail_alt,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status,
            'sort' => $request->sort,

            'meta_tag_title' => $request->meta_tag_title,
            'meta_tag_keywords' => $request->meta_tag_keywords,
            'meta_tag_description' => $request->meta_tag_description
        ];

        if($request->has('image'))
        {
            $data['image'] = AdminHelper::upload_image($request, $slug, 'news');
        }
        if($request->has('image_mobile'))
        {
            $data['thumbnail'] = AdminHelper::upload_image_mobile($request, $slug, 'news');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success','News updated successfully.');
        
    }

    public function status_update(News $news) {
        
        if($news->status == 1) {
            $news->status = 0;
        } else {
            $news->status = 1;
        }

        $news->save();

        return back()->with('success','News status updated successfully.');
    }

    public function delete(News $news) {
        $news->delete();
        return back()->with('success','News deleted successfully.');
    }
}
