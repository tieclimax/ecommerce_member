<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_number', 'sub_total', 'quantity', 'delivery_charge', 'status', 'total_amount', 'first_name', 'last_name', 'country', 'post_code', 'address1', 'address2', 'phone', 'email', 'payment_method', 'payment_status', 'shipping_id', 'coupon', 'owner_id'];

    public function cart_info()
    {
        return $this->hasMany('App\Models\Cart', 'order_id', 'id');
    }
    public static function getAllOrder($id)
    {
        return Order::with('cart_info')->find($id);
    }
    public static function countActiveOrder()
    {
        $data = Order::count();
        if ($data) {
            return $data;
        }
        return 0;
    }
    public static function countMyActiveOrder()
    {
        $id = Auth::user()->id;
        $data = Order::where('owner_id', $id)->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
    public static function countMySaled()
    {
        $id = Auth::user()->id;
        $data = Order::where('owner_id', $id)->where('status', 'delivered')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
    public static function countMySaledProcess()
    {
        $id = Auth::user()->id;
        $data = Order::where('owner_id', $id)->where('status', 'process')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
    public static function countMySaledCancel()
    {
        $id = Auth::user()->id;
        $data = Order::where('owner_id', $id)->where('status', 'cancel')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
