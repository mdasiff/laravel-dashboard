<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Helpers\AdminHelper;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        return view('admin.banner.index',['banners'=>$banners]);
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $rules = [
            // 'title'      => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
            $rules['image_mobile'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        if(count($rules))
        $request->validate($rules);

        $data = [
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'link'=>$request->link,
            'status'=>$request->status,

            'image_alt'=>$request->image_alt,
            'cta_text'=>$request->cta_text,
            'sort'=>$request->sort??0,

        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, null, 'banners');
        }

        if($request->hasFile('image_mobile') and !empty($request->image_mobile)){
            $data['image_mobile'] = AdminHelper::upload_image_mobile($request, null, 'banners');
        }

        Banner::create($data);

        return redirect()->route('admin.banner.index')->with('success','Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', ['banner'=>$banner]);
    }

    public function update(Request $request, Banner $banner)
    {
        $rules = [
            'title'   => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
            $rules['image_mobile'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'link'=>$request->link,
            'status'=>$request->status,

            'image_alt'=>$request->image_alt,
            'cta_text'=>$request->cta_text,
            'sort'=>$request->sort,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, null, 'banners');
        }

        if($request->hasFile('image_mobile') and !empty($request->image_mobile)){
            $data['image_mobile'] = AdminHelper::upload_image_mobile($request, null, 'banners');
        }

        $banner->update($data);
        return redirect()->route('admin.banner.index')->with('success', 'Banner updated successfully');
    }

    public function status_update(Banner $banner)
    {
        $banner->update(['status'=>$banner->status?0:1]);
        return redirect()->route('admin.banner.index')->with('success', 'Banner updated successfully');
    }

    public function delete(Banner $banner)
    {
        $banner1 = Banner::find($banner->id);
        $banner1->delete();
        return redirect()->route('admin.banner.index')->with('success', 'Banner deleted successfully');
    }
}
