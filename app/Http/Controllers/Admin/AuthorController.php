<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Author};
use App\Helpers\AdminHelper;


class AuthorController extends Controller
{
    public function index() {
        $authors = Author::get();
        return view('admin.author.index', compact('authors'));
    }

    public function create() {
        
        return view('admin.author.create');
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:authors',
            'designation' => 'required',
            'description' => 'required',
            'sort' => 'required',
            'status' => 'required'
        ];

        if($request->has('image'))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $validated = $request->validate($rules);  

        

        $slug = \Str::slug($request->name);
        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'status' => $request->status,
            'sort' => $request->sort,
        ];

        if($request->has('image'))
        {
            $data['image'] = AdminHelper::upload_image($request, $slug, 'author');
        }


        Author::create($data);

        return redirect()->route('admin.author.index')->with('success','Author created successfully.');
        
    }

    public function edit(Author $author) {
        return view('admin.author.edit', compact('author'));
    }

    public function update(Author $author, Request $request)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'sort' => 'required',
            'status' => 'required'
        ];

        if($request->has('image'))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $validated = $request->validate($rules);

        $slug = \Str::slug($request->name);
        
        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'status' => $request->status,
            'sort' => $request->sort,
        ];

        if($request->has('image'))
        {
            $data['image'] = AdminHelper::upload_image($request, $slug, 'author');
        }

        $author->update($data);

        return redirect()->route('admin.author.index')->with('success','Author updated successfully.');
        
    }

    public function status_update(Author $author) {
        
        if($author->status == 1) {
            $author->status = 0;
        } else {
            $author->status = 1;
        }

        $author->save();

        return back()->with('success','Author status updated successfully.');
    }

    public function delete(Author $author) {
        $author->delete();
        return back()->with('success','Author deleted successfully.');
    }
}
