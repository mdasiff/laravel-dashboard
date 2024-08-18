<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, ProductCategory};
use App\Helpers\AdminHelper;
use Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::orderBy('row')->get();
        return view('admin.product-category.index',['product_categories'=>$product_categories]);
    }

    public function create()
    {
        return view('admin.product-category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:product_categories',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);
        $slug = Str::slug($request->slug);
        $data = [
            'name'=>$request->name,
            'slug'=>$slug,
            'sort'=>$request->sort,
            'status'=>$request->status,
            'description'=>$request->description,
            'row'=>$request->row,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'product');
        }

        ProductCategory::create($data);

        

        return redirect()->route('admin.product-category.index')->with('success', 'Category created successfully');
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-category.edit', ['sc'=>$productCategory]);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $rules = [
            'name' => 'required|unique:product_categories,id,'.$productCategory->id,
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
            'row'=>$request->row,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'product');
        }

        $productCategory->update($data);
        return redirect()->route('admin.product-category.index')->with('success', 'Category updated successfully');
    }

    public function status_update(ProductCategory $productCategory)
    {
        $productCategory->update(['status'=>$productCategory->status?0:1]);
        return redirect()->route('admin.product-category.index')->with('success', 'Category updated successfully');
    }

    public function delete(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect()->route('admin.product-category.index')->with('success', 'Category deleted successfully');
    }
}
