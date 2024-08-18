<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Industry, IndustryCategory};
use App\Helpers\AdminHelper;
use Str;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::get();
        return view('admin.industry.index',['industries'=>$industries]);
    }

    public function create()
    {
        $categories = IndustryCategory::get();
        return view('admin.industry.create',['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        if($request->hasFile('file') and !empty($request->file))
        {
            $rules['file'] = 'mimes:pdf|max:3048';
        }

        $request->validate($rules);
        $slug = Str::slug($request->slug);
        $data = [
            'industry_category_id'=>$request->category,
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
            'sort'=>$request->sort,
            'slug'=>$slug,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, null, 'industry');
        }

        if($request->hasFile('file') and !empty($request->file)){
            $data['file'] = AdminHelper::upload_file($request, null, 'industry');
        }

        Industry::create($data);

        AdminHelper::makeView('industry/'.$slug);

        return redirect()->route('admin.industry.index')->with('success', 'Industry created successfully');
    }

    public function edit(Industry $industry)
    {
        $categories = IndustryCategory::get();
        return view('admin.industry.edit',['ic'=>$industry, 'categories'=>$categories]);
    }

    public function update(Request $request, Industry $industry)
    {
        $rules = [
            'name' => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);
        $slug = Str::slug($request->name);
        $data = [
            'industry_category_id'=>$request->category,
            'name'=>$request->name,
            'slug'=>$slug,
            'description'=>$request->description,
            'sort'=>$request->sort,
            'status'=>$request->status,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'industry');
        }

        if($request->hasFile('file') and !empty($request->file)){
            $data['file'] = AdminHelper::upload_file($request, Str::slug($request->name), 'industry');
        }

        $industry->update($data);

        AdminHelper::makeView('industry/'.$slug);
        
        return redirect()->route('admin.industry.index')->with('success', 'Industry updated successfully');
    }

    public function status_update(Industry $industry)
    {
        $industry->update(['status'=>$industry->status?0:1]);
        return redirect()->route('admin.industry.index')->with('success', 'Industry updated successfully');
    }

    public function delete(Industry $industry)
    {
        $industry->delete();
        return redirect()->route('admin.industry.index')->with('success', 'Industry deleted successfully');
    }
}
