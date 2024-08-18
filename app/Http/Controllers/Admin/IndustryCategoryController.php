<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Industry, IndustryCategory};
use App\Helpers\AdminHelper;
use Str;

class IndustryCategoryController extends Controller
{
    public function index()
    {
        $industry_categories = IndustryCategory::get();
        return view('admin.industry-category.index',['industry_categories'=>$industry_categories]);
    }

    public function create()
    {
        return view('admin.industry-category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:service_categories',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->slug),
            'sort'=>$request->sort,
            'status'=>$request->status,
            'description'=>$request->description,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,

        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'industry');
        }

        IndustryCategory::create($data);

        return redirect()->route('admin.industry-category.index')->with('success', 'Industry Category created successfully');
    }

    public function edit(IndustryCategory $industryCategory)
    {
        return view('admin.industry-category.edit', ['ic'=>$industryCategory]);
    }

    public function update(Request $request, IndustryCategory $industryCategory)
    {
        $rules = [
            'name' => 'required|unique:industry_categories,id,'.$industryCategory->id,
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->slug),
            'sort'=>$request->sort,
            'status'=>$request->status,
            'description'=>$request->description,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'industry');
        }

        $industryCategory->update($data);
        return redirect()->route('admin.industry-category.index')->with('success', 'Industry Category updated successfully');
    }

    public function status_update(IndustryCategory $industryCategory)
    {
        $industryCategory->update(['status'=>$industryCategory->status?0:1]);
        return redirect()->route('admin.industry-category.index')->with('success', 'Industry Category updated successfully');
    }

    public function delete(IndustryCategory $industryCategory)
    {
        $industryCategory->delete();
        return redirect()->route('admin.industry-category.index')->with('success', 'Industry Category deleted successfully');
    }
}
