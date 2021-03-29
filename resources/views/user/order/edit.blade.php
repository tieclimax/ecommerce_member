@extends('user.layouts.master')

@section('title', 'Order Detail')

@section('main-content')
    <div class="card">
        <h5 class="card-header"> แก้ไขคำสั่งซื้อ </h5>
        <div class="card-body">
            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="status">สถานะ :</label>
                    <select name="status" id="" class="form-control">
                        <option value="">--เลือกสถานะ--</option>
                        <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>ใหม่</option>
                        <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}> กำลังดำเนินการ </option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}> จัดส่งแล้ว </option>
                        <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>ยกเลิก</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">อัปเดต</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,
        .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4,
        .shipping-info h4 {
            text-decoration: underline;
        }

    </style>
@endpush
