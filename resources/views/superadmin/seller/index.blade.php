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
            <h6 class="m-0 font-weight-bold text-primary float-left">จัดการผู้ลงทะเบียนขายสินค้า</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($sellers) > 0)
                    <table class="table table-bordered" id="seller-dataTable" width="100%">
                        <thead>
                            <tr>

                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                                <th>รูปโปรไฟล์</th>
                                <th>รูปใบอนุญาติการลงขายสินค้า</th>
                                <th>บทบาท</th>
                                <th>สถานะ</th>
                                <th>วันที่ลงทะเบียน</th>
                                <th> การกระทำ </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($sellers as $seller)

                                <tr>

                                    <td>{{ $seller->name }}</td>
                                    <td>{{ $seller->email }}</td>
                                    <td>
                                        @if ($seller->photo)
                                            @php
                                                $photo = explode(',', $seller->photo);
                                                // dd($photo);
                                            @endphp
                                            <img src="{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px"
                                                alt="{{ $seller->photo }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                                style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        @if ($seller->photo_cert)
                                            @php
                                                $photo_cert = explode(',', $seller->photo_cert);
                                                // dd($photo);
                                            @endphp
                                            <img src="{{ $photo_cert[0] }}" class="img-fluid zoom"
                                                style="max-width:80px;max-height:80px" alt="{{ $seller->photo_cert }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                                style="max-width:80px;max-height:80px" alt="avatar.png">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($seller->role == 'admin')
                                            ผู้ขายสินค้า
                                        @endif
                                    </td>
                                    <td>
                                        @if ($seller->status == 'pending')
                                            รอการอนุมัติ
                                        @endif
                                    </td>
                                    <td>{{ $seller->updated_at->format('D d M, Y') }} <br>
                                        at
                                        {{ $seller->created_at->format('g : i a') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('seller-management.edit', $seller->id) }}"
                                            class="btn btn-success btn-sm float-left mr-1"
                                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                            title="show" data-placement="bottom"><i class="fas fa-edit"></i></a>

                                        {{-- <form method="post"
                                            action="{{ route('product-management.destroy', [$seller->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $seller->id }}
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i class="fas fa-ban"></i></button>
                                        </form> --}}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span style="float:right">{{ $sellers->links() }}</span>
                @else
                    <h6 class="text-center mt-3">ไม่มีผู้ใช้รอการอนุมัติการลงทะเบียนขายกับเรา</h6>
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

        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(5.5);
        }

    </style>
@endpush

@push('scripts')


    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}


    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#seller-dataTable').dataTable({
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
