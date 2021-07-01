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
            <h6 class="m-0 font-weight-bold text-primary float-left">รายการโพสต์</h6>
            <a href="{{ route('superadminpost.create') }}" class="btn btn-primary btn-sm float-right"
                data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> เพิ่มโพสต์</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($posts) > 0)
                    <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>หัวข้อ</th>
                                <th>หมวดหมู่</th>
                                <th>Tag</th>
                                <th> ผู้แต่ง </th>
                                <th>รูป</th>
                                <th>สถานะ</th>
                                <th> การกระทำ </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($posts as $post)
                                @php
                                    $author_info = DB::table('users')
                                        ->select('name')
                                        ->where('id', $post->added_by)
                                        ->get();
                                    // dd($sub_cat_info);
                                    // dd($author_info);
                                @endphp
                                <tr>


                                    <td>{{ $post->cat_info->title }}</td>
                                    <td>{{ $post->tags }}</td>

                                    <td>
                                        @foreach ($author_info as $data)
                                            {{ $data->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($post->photo)
                                            <img src="{{ $post->photo }}" class="img-fluid zoom" style="max-width:80px"
                                                alt="{{ $post->photo }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                                style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->status == 'active')
                                            <span class="badge badge-success">{{ $post->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $post->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('superadminpost.edit', $post->id) }}"
                                            class="btn btn-primary btn-sm float-left mr-1"
                                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                            title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('superadminpost.destroy', [$post->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $post->id }}
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span style="float:right">{{ $posts->links() }}</span>
                @else
                    <h6 class="text-center mt-3">ไม่พบกระทู้ !!! โปรดสร้างโพสต์</h6>
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
            transform: scale(5);
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
        $('#product-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [8, 9, 10]
            }]
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
