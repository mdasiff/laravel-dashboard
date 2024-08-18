<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Resource, ResourceCategory};
use App\Helpers\AdminHelper;
use Str;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::get();
        return view('admin.resource.index',['resources'=>$resources]);
    }

    public function create()
    {
        $categories = ResourceCategory::get();
        return view('admin.resource.create',['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        if($request->hasFile('image_mobile') and !empty($request->image))
        {
            $rules['image_mobile'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        if($request->hasFile('file') and !empty($request->file))
        {
            $rules['file'] = 'required|mimes:pdf|max:3048';
        }

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'resource_category_id'=>$request->category,
            'name'=>$request->name,
            'description'=>$request->description,
            'image_alt'=>$request->image_alt,
            'home_image_alt'=>$request->home_image_alt,
            'status'=>$request->status,
            'show_on_home_page' => $request->show_on_home_page==1?1:0,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, null, 'resource');
        }

        if($request->hasFile('image_mobile') and !empty($request->image_mobile)){
            $data['home_image'] = AdminHelper::upload_image_mobile($request, 'home', 'resource');
        }

        if($request->hasFile('file') and !empty($request->file)){
            $data['file'] = AdminHelper::upload_file($request, null, 'resource');
        }

        Resource::create($data);

        return redirect()->route('admin.resource.index')->with('success', 'Resource created successfully');
    }

    public function edit(Resource $resource)
    {
        $categories = ResourceCategory::get();
        return view('admin.resource.edit',['rc'=>$resource, 'categories'=>$categories]);
    }

    public function update(Request $request, Resource $resource)
    {
        $rules = [
            'name'   => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'resource_category_id'=>$request->category,
            'name'=>$request->name,
            'image_alt'=>$request->image_alt,
            'description'=>$request->description,
            'home_image_alt'=>$request->home_image_alt,
            'status'=>$request->status,
            'show_on_home_page' => $request->show_on_home_page==1?1:0,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'resource');
        }

        if($request->hasFile('file') and !empty($request->file)){
            $data['file'] = AdminHelper::upload_file($request, Str::slug($request->name), 'resource');
        }

        if($request->hasFile('image_mobile') and !empty($request->image_mobile)){
            $data['home_image'] = AdminHelper::upload_image_mobile($request, 'home', 'resource');
        }

        $resource->update($data);
        
        return redirect()->route('admin.resource.index')->with('success', 'Resource updated successfully');
    }

    public function status_update(Resource $resource)
    {
        $resource->update(['status'=>$resource->status?0:1]);
        return redirect()->route('admin.resource.index')->with('success', 'Resource updated successfully');
    }

    public function delete(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resource.index')->with('success', 'Resource deleted successfully');
    }
}
