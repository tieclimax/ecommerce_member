<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::getAllProduct()->where('product_confirmed', '0');
        $products = Product::where('product_confirmed', '0')->orderBy('updated_at', 'ASC')->get();
        // dd($products);
        return view('superadmin.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return '';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('superadmin.product.edit')->with('product', $product);
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
        // dd('update');
        $product = Product::findOrFail($id);
        $product->product_confirmed = '1';
        $status = $product->save();
        // dd($status);
        if ($status) {
            request()->session()->flash('success', 'อนุมัติสินค้าเรียบร้อยแล้ว');
        } else {
            request()->session()->flash('error', 'กรุณาลองอีกครั้ง!!');
        }
        return redirect()->route('product-management.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd('cancel');
        $product = Product::findOrFail($id);
        // dd($product);
        $product->product_confirmed = '3';
        $status = $product->save();
        // dd($status);
        if ($status) {
            request()->session()->flash('success', 'ยกเลิกสินค้าเรียบร้อยแล้ว');
        } else {
            request()->session()->flash('error', 'กรุณาลองอีกครั้ง!!');
        }
        return redirect()->route('product-management.index');
    }
}
