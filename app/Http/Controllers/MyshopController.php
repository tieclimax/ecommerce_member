<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MyshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $id = Auth::user()->id;

        $products = Product::getMyProduct();
        // dd($products);

        // return $products;
        return view('backend.myproduct.index')->with('products', $products);
    }

    public function show()
    {
        $products = Product::getMyProductPadding();
        // dd($products);
        return view('backend.myproduct.productpadding')->with('products', $products);
    }

    public function create()
    {
        $owner_id = Auth::user();
        $brand = Brand::where('owner_id', $owner_id->id)->get();
        $category = Category::where('is_parent', 1)->get();


        // return $category;
        return view('backend.myproduct.create')->with('categories', $category)->with('brands', $brand);
    }
    public function store(Request $request)
    {

        // dd($request->all());
        $this->validate($request, [
            'owner_id' => 'required',
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);
        $data = $request->all();
        // dd($data);
        $slug = ($request->title);
        // dd($slug);
        $count = Product::where('slug', $slug)->count();
        // dd($count);
        if ($count > 0) {
            $slug = $slug . '-' . date('Y:m:d') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        // dd($data['slug']);
        $data['is_featured'] = $request->input('is_featured', 0);
        $data['product_confirmed'] = $request->input('product_confirmed', 0);
        // dd($data['is_featured']);
        $size = $request->input('size');
        // dd($size);
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            // dd($size);
            $data['size'] = '';
        }
        // dd($data);
        $countTitle = Product::where('title', $data['title'])->count();
        if ($countTitle == 0) {
            $status = Product::create($data);
            // dd($status);
            if ($status) {


                // request()->session()->flash('success', 'เพิ่มสินค้าสำเร็จ!!');
                return back()->with('success', 'เพิ่มสินค้าสำเร็จ!');
                // return redirect()->route('myproduct.create');
            } else {
                // request()->session()->flash('error', 'เพิ่มสินค้าไม่สำเร็จ!!');
                return back()->with('fail', 'เพิ่มสินค้าไม่สำเร็จ!');
                // return redirect()->route('myproduct.create');
            }
        } else {
            return back()->with('fail', 'มีชื่อสินค้าซ้ำ!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::get();
        $product = Product::findOrFail($id);
        $category = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
        // return $items;
        return view('backend.myproduct.edit')->with('product', $product)
            ->with('brands', $brand)
            ->with('categories', $category)->with('items', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'owner_id' => 'required',
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }
        // return $data;
        $status = $product->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'แก้ไขสินค้าสำเร็จ!');
        } else {
            request()->session()->flash('error', 'แก้ไขสินค้าไม่สำเร็จ!');
        }
        return redirect()->route('myproduct.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        if ($status) {
            request()->session()->flash('success', 'ลบสินค้าสำเร็จ!');
        } else {
            request()->session()->flash('error', 'ลบสินค้าไม่สำเร็จ!');
        }
        return redirect()->route('myproduct.index');
    }
}
