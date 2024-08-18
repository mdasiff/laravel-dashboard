<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MarketplaceCategory};
use App\Helpers\AdminHelper;
use Str;

class MarketplacecategoryController extends Controller
{
    public function index()
    {
        $marketplace_categories = MarketplaceCategory::get();
        return view('admin.marketplace-category.index',['marketplace_categories'=>$marketplace_categories]);
    }

    public function create()
    {
        return view('admin.marketplace-category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:marketplace_categories',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            //$rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'marketplace');
        }

        MarketplaceCategory::create($data);

        return redirect()->route('admin.marketplace-category.index')->with('success', 'Marketplace Category created successfully');
    }

    public function edit(MarketplaceCategory $marketplaceCategory)
    {
        return view('admin.marketplace-category.edit', ['sc'=>$marketplaceCategory]);
    }

    public function update(Request $request, MarketplaceCategory $marketplaceCategory)
    {
        $rules = [
            'name' => 'required|unique:marketplace_categories,id,'.$marketplaceCategory->id,
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'marketplace');
        }

        $marketplaceCategory->update($data);
        return redirect()->route('admin.marketplace-category.index')->with('success', 'Marketplace Category updated successfully');
    }

    public function status_update(MarketplaceCategory $marketplaceCategory)
    {
        $marketplaceCategory->update(['status'=>$marketplaceCategory->status?0:1]);
        return redirect()->route('admin.marketplace-category.index')->with('success', 'Marketplace Category updated successfully');
    }

    public function delete(MarketplaceCategory $marketplaceCategory)
    {
        $marketplaceCategory->delete();
        return redirect()->route('admin.marketplace-category.index')->with('success', 'Marketplace Category deleted successfully');
    }
}
