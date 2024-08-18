<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Service, ServiceCategory};
use App\Helpers\AdminHelper;
use Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::get();
        return view('admin.service.index',['services'=>$services]);
    }

    public function create()
    {
        $categories = ServiceCategory::get();
        return view('admin.service.create',['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        // if($request->hasFile('file') and !empty($request->file))
        // {
        //     $rules['file'] = 'required|mimes:pdf|max:3048';
        // }

        $request->validate($rules);

        $data = [
            'service_category_id'=>$request->category,
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description,
            'status'=>$request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, null, 'service');
        }

        // if($request->hasFile('file') and !empty($request->file)){
        //     $data['file'] = AdminHelper::upload_file($request, null, 'service');
        // }

        Service::create($data);

        return redirect()->route('admin.service.index')->with('success', 'Service created successfully');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::get();
        return view('admin.service.edit',['sc'=>$service, 'categories'=>$categories]);
    }

    public function update(Request $request, Service $service)
    {
        $rules = [
            'name' => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'service_category_id'=>$request->category,
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'resource');
        }

        if($request->hasFile('file') and !empty($request->file)){
            $data['file'] = AdminHelper::upload_file($request, Str::slug($request->name), 'resource');
        }

        $service->update($data);
        
        return redirect()->route('admin.service.index')->with('success', 'Service updated successfully');
    }

    public function status_update(Service $service)
    {
        $service->update(['status'=>$service->status?0:1]);
        return redirect()->route('admin.service.index')->with('success', 'Service updated successfully');
    }

    public function delete(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.service.index')->with('success', 'Service deleted successfully');
    }
}
