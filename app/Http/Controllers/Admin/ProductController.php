<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, ProductCategory};
use App\Helpers\AdminHelper;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index',['products'=>$products]);
    }

    public function create()
    {
        $categories = ProductCategory::get();
        return view('admin.product.create',['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:products',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);
        $slug = Str::slug($request->name);
        $data = [
            'product_category_id'=>$request->category,
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'product');
        }

        Product::create($data);

        AdminHelper::makeView('products/'.$slug);

        return redirect()->route('admin.product.index')->with('success', 'Category created successfully');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::get();
        return view('admin.product.edit', ['sc'=>$product, 'categories'=>$categories]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|unique:products,id,'.$product->id,
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'product_category_id'=>$request->category,
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
            $data['image'] = AdminHelper::upload_image($request, Str::slug($request->name), 'product');
        }

        $product->update($data);
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    

    public function status_update(Product $product)
    {
        $product->update(['status'=>$product->status?0:1]);
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully');
    }
}
