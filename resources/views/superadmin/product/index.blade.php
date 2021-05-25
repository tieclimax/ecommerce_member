@extends('superadmin.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('superadmin.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">รายการสินค้ารอการตรวจสอบ</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($products) > 0)
                    <table class="table table-bordered product-dataTable" id="" width="100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>หัวข้อ</th>
                                <th>หมวดหมู่</th>
                                <th>กำลังมาเเรง</th>
                                <th>ราคา</th>
                                <th>ส่วนลด</th>
                                <th>ขนาด</th>
                                <th> เงื่อนไข </th>
                                <th> แบรนด์ </th>
                                <th> อยู่ในคลัง </th>
                                <th>รูป</th>
                                <th>สถานะ</th>
                                <th> การกระทำ </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ลำดับ</th>
                                <th>หัวข้อ</th>
                                <th>หมวดหมู่</th>
                                <th>กำลังมาเเรง</th>
                                <th>ราคา</th>
                                <th>ส่วนลด</th>
                                <th>ขนาด</th>
                                <th> เงื่อนไข </th>
                                <th> แบรนด์ </th>
                                <th> อยู่ในคลัง </th>
                                <th>รูป</th>
                                <th>สถานะ</th>
                                <th> การกระทำ </th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($products as $product)
                                @php
                                    $sub_cat_info = DB::table('categories')
                                        ->select('title')
                                        ->where('id', $product->child_cat_id)
                                        ->get();
                                    // dd($sub_cat_info);
                                    $brands = DB::table('brands')
                                        ->select('title')
                                        ->where('id', $product->brand_id)
                                        ->get();
                                @endphp
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->cat_info['title'] }}
                                        <sub>
                                            @foreach ($sub_cat_info as $data)
                                                {{ $data->title }}
                                            @endforeach
                                        </sub>
                                    </td>
                                    <td>{{ $product->is_featured == 1 ? 'ใช่' : 'ไม่ใช่' }}</td>
                                    <td>{{ $product->price }} ฿</td>
                                    @if ($product->discount == null)
                                        <td> - </td>
                                    @else
                                        <td> {{ $product->discount }}% OFF</td>
                                    @endif
                                    @if ($product->size == null)
                                        <td>-</td>
                                    @else

                                        <td>{{ $product->size }}</td>
                                    @endif
                                    @if ($product->condition == 'default')
                                        <td> ปกติ</td>
                                    @else
                                        <td>{{ $product->condition }}</td>
                                    @endif

                                    <td>
                                        @if ($product->brand_id == null)
                                            ไม่มียี่ห้อ
                                        @endif
                                        @foreach ($brands as $brand)
                                            {{ $brand->title }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($product->stock > 0)
                                            <span class="badge badge-primary">{{ $product->stock }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->photo)
                                            @php
                                                $photo = explode(',', $product->photo);
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
                                        @if ($product->status == 'active')
                                            <span class="badge badge-success">{{ $product->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $product->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('product-management.edit', $product->id) }}"
                                            class="btn btn-success btn-sm float-left mr-1"
                                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                            title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>

                                        <form method="post"
                                            action="{{ route('product-management.destroy', [$product->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $product->id }}
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i class="fas fa-ban"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <span style="float:right">{{ $products->links() }}</span> --}}
                @else
                    <h6 class="text-center mt-3">ไม่มีสินค้ารอการอนุมัติ กรุณารอสินค้าจากผู้ขาย</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    {{-- <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        /* div.dataTables_wrapper div.dataTables_paginate {
                                                                                                                                                                                                                                                                                                                                                                                                                        display: none;
                                                                                                                                                                                                                                                                                                                                                                                                                    } */

        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(4);
        }

    </style>
@endpush

@push('scripts')


    <!-- Page level plugins -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        // $('#product-dataTable').DataTable({
        //     "columnDefs": [{
        //         "orderable": false,
        //         "targets": [3, 4, 5]
        //     }]
        // });
        $(document).ready(function() {
            $('.product-dataTable').DataTable();
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
                        title: "คุณแน่ใจที่จะยกเลิกสินค้านี้หรือไม่?",
                        text: "เมื่อยกเลิกแล้วคุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willCancel) => {
                        if (willCancel) {
                            form.submit();
                        } else {
                            swal("ยกเลิกเเล้ว");
                        }
                    });
            })
            $('.udtBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "คุณแน่ใจที่จะอนุมัติสินค้าหรือไม่?",
                        // text: "เมื่อลบแล้วคุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("ยกเลิกเเล้ว");
                        }
                    });
            })
        })

    </script>
@endpush
