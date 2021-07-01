@extends('user.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('user.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">รายการคำสั่งซื้อ</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($orders) > 0)
                    <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th> หมายเลขคำสั่งซื้อ </th>
                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                                <th> ปริมาณ </th>
                                <th>ค่าบริการเพิ่มเติม</th>
                                <th> จำนวนเงินทั้งหมด </th>
                                <th>สถานะ</th>
                                <th>รูปภาพ</th>
                                <th> การกระทำ </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $shipping_charge = DB::table('shippings')
                                        ->where('id', $order->shipping_id)
                                        ->pluck('price');
                                @endphp
                                <tr>

                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>
                                        @foreach ($shipping_charge as $data) ฿
                                            {{ number_format($data, 2) }} @endforeach
                                    </td>
                                    <td>฿{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        @if ($order->status == 'new')
                                            <span class="badge badge-primary">รอการยืนยัน</span>
                                        @elseif($order->status=='process')
                                            <span class="badge badge-warning">กำลังดำเนินการ</span>
                                        @elseif($order->status=='delivered')
                                            <span class="badge badge-success">จัดส่งแล้ว</span>
                                        @else
                                            <span class="badge badge-danger">ยกเลิก</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->slip_photo)
                                            @php
                                                $photo = explode(',', $order->slip_photo);
                                                // dd($photo);
                                            @endphp
                                            <img src="{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px"
                                                alt="{{ $product->photo }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                                style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.order.show', $order->id) }}"
                                            class="btn btn-warning btn-sm float-left mr-1"
                                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                            title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                        @if ($order->payment_method == 'netbank')
                                            <a href="{{ route('user.order.edit', $order->id) }}"
                                                class="btn btn-primary btn-sm float-left mr-1"
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                title="add slip" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        @endif
                                        <form method="POST" action="{{ route('user.order.delete', [$order->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $order->id }}
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span style="float:right">{{ $orders->links() }}</span>
                @else
                    <h6 class="text-center mt-3">ไม่พบคำสั่งซื้อ !!! กรุณาสั่งซื้อสินค้าบางรายการ</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

    </style>
    <style>
        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(3);
        }

    </style>
@endpush

@push('scripts')

    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#order-dataTable').dataTable({
                "order": [
                    [0, "desc"]
                ],
                "bOrdering": true,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false
            });
        });

        // Sweet alert

        function deleteData(id) {

        }
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "คุณแน่ใจไหม?",
                        text: "เมื่อลบแล้วคุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("ข้อมูลของคุณปลอดภัย!");
                        }
                    });
            })
        })
    </script>
@endpush
