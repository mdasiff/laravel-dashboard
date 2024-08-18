<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{LifeMerino};
use App\Helpers\AdminHelper;

class LifeMerinoController extends Controller
{
    public function index()
    {
        $life_merinos = LifeMerino::get();
        return view('admin.life_merino.index',compact('life_merinos'));
    }

    public function create()
    {   
        return view('admin.life_merino.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'image_alt'   => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:3048'
        ];

        $request->validate($rules);

        $data = [
            'image_alt' => $request->image_alt,
            'sort' => $request->sort,
            'status' => $request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, \Str::slug($request->image_alt), 'life-at-merino');
        }

        LifeMerino::create($data);

        return redirect()->route('admin.life_merino.index')->with('success', 'Life@Mrino created successfully');
    }

    public function edit(LifeMerino $life_merino)
    {
        return view('admin.life_merino.edit', compact('life_merino'));
    }

    public function update(Request $request, LifeMerino $life_merino)
    {
        $rules = [
            'image_alt'   => 'required'
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'image_alt' => $request->image_alt,
            'sort' => $request->sort,
            'status' => $request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, \Str::slug($request->image_alt), 'life-at-merino');
        }

        $life_merino->update($data);

        return redirect()->route('admin.life_merino.index')->with('success', 'Life@Mrino updated successfully');
    }

    public function status_update(LifeMerino $life_merino) {
        if($life_merino->status == 1) {
            $life_merino->status = 0;
        } else {
            $life_merino->status = 1;
        }
        $life_merino->save();
        return back()->with('success','Life@Mrino updated successfully.');
    }

    public function delete(LifeMerino $life_merino) {
        $life_merino->delete();
        return back()->with('success','Life@Mrino delete successfully.');
    }

}
