@extends('backend.layouts.master')

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
                    <select name="status" id="status" class="form-control">
                        <option value="">--เลือกสถานะ--</option>
                        <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>ใหม่</option>
                        <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}> กำลังดำเนินการ
                        </option>
                        <option value="delivered" id="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                            จัดส่งแล้ว
                        </option>
                        <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>ยกเลิก</option>
                    </select>
                </div>
                <div class="form-group d-none" id="delivered_div">
                    <label for="postnumber">กรอกเลขพัสดุ :</label>
                    <input type="text" class="form-control" id="post_number" name="post_number" placeholder="">
                </div>
                <button type="submit" class="btn btn-primary">อัปเดต</button>
            </form>
        </div>
    </div>

@endsection


@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

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
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>
        $("#status").change(function() {
            var data = $(this).val();
            if (data == "delivered") {
                $('#delivered_div').removeClass('d-none');
                $('#delivered_div').show();
            } else {
                $('#delivered_div').addClass('d-none');
                $('#delivered_div').hide();
            }
        });

    </script>
@endpush
