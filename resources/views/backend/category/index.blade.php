@extends('backend.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Category Lists</h6>
            <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
                data-placement="bottom" title=""><i class="fas fa-plus"></i> Add Category</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($categories) > 0)
                    <table class="table table-bordered banner-dataTable" id="" width="100%">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Is Parent</th>
                                <th>Parent Category</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>IsFeatured</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Is Parent</th>
                                <th>Parent Category</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>IsFeatured</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($categories as $category)
                                @php
                                    $parent_cats = DB::table('categories')
                                        ->select('title')
                                        ->where('id', $category->parent_id)
                                        ->get();
                                    // dd($parent_cats);
                                @endphp
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->is_parent == 1 ? 'Yes' : 'No' }}</td>
                                    <td>
                                        @foreach ($parent_cats as $parent_cat)
                                            {{ $parent_cat->title }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($category->photo)
                                            <img src="{{ $category->photo }}" class="img-fluid" style="max-width:80px"
                                                alt="{{ $category->photo }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                                style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category->status == 'active')
                                            <span class="badge badge-success">{{ $category->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $category->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category->is_featured == 'active')
                                            <span class="badge badge-success">{{ $category->is_featured }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $category->is_featured }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-primary btn-sm float-left mr-1"
                                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                            title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('category.destroy', [$category->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $category->id }}
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                    {{-- Delete Modal --}}
                                    {{-- <div class="modal fade" id="delModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$user->id}}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="#delModal{{$user->id}}Label">Delete user</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="{{ route('categorys.destroy',$user->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" style="margin:auto; text-align:center">Parmanent delete user</button>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <span style="float:right">{{ $categories->links() }}</span> --}}
                @else
                    <h6 class="text-center">No Categories found!!! Please create Category</h6>
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

    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <!-- Page level plugins -->
    {{-- <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        // $('.banner-dataTable').DataTable({
        //     "columnDefs": [{
        //         "orderable": false,
        //         "targets": [3, 4, 5]
        //     }]
        // });
        $(document).ready(function() {
            $('.banner-dataTable').DataTable();
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
                        title: "คุณแน่ใจที่จะลบหรือไม่?",
                        text: "เมื่อลบแล้วคุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
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
