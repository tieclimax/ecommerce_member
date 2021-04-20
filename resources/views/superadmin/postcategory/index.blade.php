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
            <h6 class="m-0 font-weight-bold text-primary float-left"> รายการหมวดหมู่โพสต์ </h6>
            <a href="{{ route('superadminpost-category.create') }}" class="btn btn-primary btn-sm float-right"
                data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i>
                เพิ่มหมวดหมู่โพสต์
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($postCategories) > 0)
                    <table class="table table-bordered" id="post-category-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>หัวข้อ</th>
                                <th>คำอธิบายสั้น</th>
                                <th>สถานะ</th>
                                <th> การกระทำ </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ลำดับ</th>
                                <th>หัวข้อ</th>
                                <th>คำอธิบายสั้น</th>
                                <th>สถานะ</th>
                                <th> การกระทำ </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($postCategories as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->slug }}</td>
                                    <td>
                                        @if ($data->status == 'active')
                                            <span class="badge badge-success">{{ $data->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $data->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('superadminpost-category.edit', $data->id) }}"
                                            class="btn btn-primary btn-sm float-left mr-1"
                                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                            title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST"
                                            action="{{ route('superadminpost-category.destroy', [$data->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $data->id }}
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span style="float:right">{{ $postCategories->links() }}</span>
                @else
                    <h6 class="text-center mt-3">ไม่พบหมวดหมู่โพสต์ !!! โปรดสร้างหมวดหมู่โพสต์</h6>
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
@endpush

@push('scripts')

    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#post-category-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [3, 4]
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
