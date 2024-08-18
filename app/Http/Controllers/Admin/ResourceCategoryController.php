<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Resource, ResourceCategory};
use App\Helpers\AdminHelper;
use Str;

class ResourceCategoryController extends Controller
{
    public function index()
    {
        $resource_categories = ResourceCategory::get();
        return view('admin.resource-category.index',['resource_categories'=>$resource_categories]);
    }

    public function create()
    {
        return view('admin.resource-category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|unique:resource_categories',
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'resource');
        }

        ResourceCategory::create($data);

        return redirect()->route('admin.resource-category.index')->with('success', 'Resource Category created successfully');
    }

    public function edit(ResourceCategory $resourceCategory)
    {
        return view('admin.resource-category.edit', ['rc'=>$resourceCategory]);
    }

    public function update(Request $request, ResourceCategory $resourceCategory)
    {
        $rules = [
            'name'   => 'required|unique:resource_categories,id,'.$resourceCategory->id,
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'resource');
        }

        $resourceCategory->update($data);
        return redirect()->route('admin.resource-category.index')->with('success', 'Resource Category updated successfully');
    }

    public function status_update(ResourceCategory $resourceCategory)
    {
        $resourceCategory->update(['status'=>$resourceCategory->status?0:1]);
        return redirect()->route('admin.resource-category.index')->with('success', 'Resource Category updated successfully');
    }

    public function delete(ResourceCategory $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resource-category.index')->with('success', 'Resource Category deleted successfully');
    }
}
