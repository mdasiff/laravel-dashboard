<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function index() {
        $categories = BlogCategory::get();
        return view('admin.blog-category.index', ['categories' => $categories]);
    }

    public function create() {
        return view('admin.blog-category.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' =>  'required',
            'sort'   => 'required',
            'status'   => 'required',
        ]);
        
        $data = [
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'status' => $request->status==1?1:0,
            'sort' => $request->sort,
        ];

        BlogCategory::create($data);

        return redirect()->route('admin.blog-category.index')->with('success','Blog Category created successfully.');
    }

    public function edit(BlogCategory $category) {
        return view('admin.blog-category.update',compact('category'));
    }

    public function update(BlogCategory $category, Request $request) {
        $validated = $request->validate([
            'title' =>  'required',
            'sort'   => 'required',
            'status'   => 'required',
        ]);
        
        $data = [
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'status' => $request->status==1?1:0,
            'sort' => $request->sort,
        ];

        $category->update($data);

        return redirect()->route('admin.blog-category.index')->with('success','Blog Category updated successfully.');
    }

    public function status_update(BlogCategory $category) {
        if($category->status == 1) {
            $category->status = 0;
        } else {
            $category->status = 1;
        }
        $category->save();
        return redirect()->route('admin.blog-category.index')->with('success','Blog Category updated successfully.');
    }

    public function delete(BlogCategory $category) {
        $category->delete();
        return redirect()->route('admin.blog-category.index')->with('success','Blog Category delete successfully.');
    }

}
