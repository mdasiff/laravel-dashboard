<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Solution, SolutionCategory};
use App\Helpers\AdminHelper;
use Str;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::get();
        return view('admin.solution.index',['solutions'=>$solutions]);
    }

    public function create()
    {
        $categories = SolutionCategory::get();
        return view('admin.solution.create',['categories'=>$categories]);
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

        if($request->hasFile('file') and !empty($request->file))
        {
            $rules['file'] = 'required|mimes:pdf|max:3048';
        }

        $request->validate($rules);

        $data = [
            'solution_category_id'=>$request->category,
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, null, 'solution');
        }

        if($request->hasFile('file') and !empty($request->file)){
            $data['file'] = AdminHelper::upload_file($request, null, 'solution');
        }

        Solution::create($data);

        return redirect()->route('admin.solution.index')->with('success', 'Solution created successfully');
    }

    public function edit(Solution $solution)
    {
        $categories = SolutionCategory::get();
        return view('admin.solution.edit',['sc'=>$solution, 'categories'=>$categories]);
    }

    public function update(Request $request, Solution $solution)
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
            'solution_category_id'=>$request->category,
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'solution');
        }

        if($request->hasFile('file') and !empty($request->file)){
            $data['file'] = AdminHelper::upload_file($request, Str::slug($request->name), 'solution');
        }

        $solution->update($data);
        
        return redirect()->route('admin.solution.index')->with('success', 'Solution updated successfully');
    }

    public function status_update(Solution $solution)
    {
        $solution->update(['status'=>$solution->status?0:1]);
        return redirect()->route('admin.solution.index')->with('success', 'Solution updated successfully');
    }

    public function delete(Solution $solution)
    {
        $solution->delete();
        return redirect()->route('admin.solution.index')->with('success', 'Solution deleted successfully');
    }
}
