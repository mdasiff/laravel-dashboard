<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Service, ServiceCategory};
use App\Helpers\AdminHelper;
use Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $service_categories = ServiceCategory::get();
        return view('admin.service-category.index',['service_categories'=>$service_categories]);
    }

    public function create()
    {
        return view('admin.service-category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:service_categories',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            //$rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);
        $slug = Str::slug($request->slug);
        $data = [
            'name'=>$request->name,
            'slug'=>$slug,
            'sort'=>$request->sort,
            'status'=>$request->status,
            'description'=>$request->description,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,

        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'service');
        }

        ServiceCategory::create($data);

        AdminHelper::makeView('services/'.$slug);

        return redirect()->route('admin.service-category.index')->with('success', 'Resource Category created successfully');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.service-category.edit', ['sc'=>$serviceCategory]);
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $rules = [
            'name' => 'required|unique:service_categories,id,'.$serviceCategory->id,
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'sort'=>$request->sort,
            'status'=>$request->status,
            'description'=>$request->description,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'service');
        }

        $serviceCategory->update($data);
        return redirect()->route('admin.service-category.index')->with('success', 'Service Category updated successfully');
    }

    public function status_update(ServiceCategory $serviceCategory)
    {
        $serviceCategory->update(['status'=>$serviceCategory->status?0:1]);
        return redirect()->route('admin.service-category.index')->with('success', 'Service Category updated successfully');
    }

    public function delete(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('admin.service-category.index')->with('success', 'Service Category deleted successfully');
    }
}
