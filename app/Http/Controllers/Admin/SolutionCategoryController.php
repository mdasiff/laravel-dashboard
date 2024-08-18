<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Solution, SolutionCategory};
use App\Helpers\AdminHelper;
use Str;

class SolutionCategoryController extends Controller
{
    public function index()
    {
        $solution_categories = SolutionCategory::get();
        return view('admin.solution-category.index',['solution_categories'=>$solution_categories]);
    }

    public function create()
    {
        return view('admin.solution-category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:solution_categories',
            'slug' => 'required|unique:solution_categories',
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'solution');
        }

        SolutionCategory::create($data);

        AdminHelper::makeView('solutions/'.$slug);

        return redirect()->route('admin.solution-category.index')->with('success', 'Solution Category created successfully');
    }

    public function edit(SolutionCategory $solutionCategory)
    {
        return view('admin.solution-category.edit', ['sc'=>$solutionCategory]);
    }

    public function update(Request $request, SolutionCategory $solutionCategory)
    {
        $rules = [
            'name' => 'required|unique:solution_categories,id,'.$solutionCategory->id,
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'solution');
        }

        $solutionCategory->update($data);
        return redirect()->route('admin.solution-category.index')->with('success', 'Solution Category updated successfully');
    }

    public function status_update(SolutionCategory $solutionCategory)
    {
        $solutionCategory->update(['status'=>$solutionCategory->status?0:1]);
        return redirect()->route('admin.solution-category.index')->with('success', 'Solution Category updated successfully');
    }

    public function delete(SolutionCategory $solutionCategory)
    {
        $solutionCategory->delete();
        return redirect()->route('admin.solution-category.index')->with('success', 'Solution Category deleted successfully');
    }
}
