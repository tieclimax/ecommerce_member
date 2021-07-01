<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Cart;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::orderBy('id', 'DESC')->paginate('10');
        return view('superadmin.coupon.index')->with('coupons', $coupon);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'code' => 'string|required',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        $data = $request->all();
        $status = Coupon::create($data);
        if ($status) {
            request()->session()->flash('success', 'ใช้งานคูปองสำเร็จ');
        } else {
            request()->session()->flash('error', 'กรุณาลองอีกครั้ง!!');
        }
        return redirect()->route('superadmincoupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            return view('superadmin.coupon.edit')->with('coupon', $coupon);
        } else {
            return view('superadmin.coupon.index')->with('error', 'Coupon not found');
        }
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
        $coupon = Coupon::find($id);
        $this->validate($request, [
            'code' => 'string|required',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        $data = $request->all();

        $status = $coupon->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'อัพเดทคูปองสำเร็จ');
        } else {
            request()->session()->flash('error', 'กรุณาลองอีกครั้ง!!');
        }
        return redirect()->route('superadmincoupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $status = $coupon->delete();
            if ($status) {
                request()->session()->flash('success', 'ลบคูปองสำเร็จ');
            } else {
                request()->session()->flash('error', 'ข้อผิดพลาด, กรุณาลองอีกครั้ง!');
            }
            return redirect()->route('superadmincoupon.index');
        } else {
            request()->session()->flash('error', 'ไม่พบคูปอง');
            return redirect()->back();
        }
    }

    public function couponStore(Request $request)
    {
        // return $request->all();
        $coupon = Coupon::where('code', $request->code)->first();
        // dd($coupon);
        if (!$coupon) {
            request()->session()->flash('error', 'Invalid coupon code, กรุณาลองอีกครั้ง!');
            return back();
        }
        if ($coupon) {
            $total_price = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('price');
            // dd($total_price);
            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($total_price)
            ]);
            request()->session()->flash('success', 'ใช้งานคูปองสำเร็จ');
            return redirect()->back();
        }
    }
}
