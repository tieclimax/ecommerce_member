@extends('user.layouts.master')

@section('title', 'Admin โปรไฟล์')

@section('main-content')

    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h4 class=" font-weight-bold">โปรไฟล์</h4>
            <ul class="breadcrumbs">
                <li><a href="{{ route('admin') }}" style="color:#999">แดชบอร์ด</a></li>
                <li><a href="" class="active text-primary">หน้าโปรไฟล์</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="image">
                            @if ($profile->photo)
                                <img class="card-img-top img-fluid roundend-circle mt-4"
                                    style="border-radius:50%;height:80px;width:80px;margin:auto;"
                                    src="{{ $profile->photo }}" alt="profile picture">
                            @else
                                <img class="card-img-top img-fluid roundend-circle mt-4"
                                    style="border-radius:50%;height:80px;width:80px;margin:auto;"
                                    src="{{ asset('backend/img/avatar.png') }}" alt="profile picture">
                            @endif
                        </div>
                        <div class="card-body mt-4 ml-2">
                            <h5 class="card-title text-left"><small><i class="fas fa-user"></i>
                                    {{ $profile->name }}</small>
                            </h5>
                            <p class="card-text text-left"><small><i class="fas fa-envelope"></i>
                                    {{ $profile->email }}</small></p>
                            <p class="card-text text-left"><small class="text-muted"><i class="fas fa-hammer"></i>
                                    {{ $profile->role }}</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form class="border px-4 pt-2 pb-3" method="POST"
                        action="{{ route('user-profile-update', $profile->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">ชื่อ</label>
                            <input id="inputTitle" type="text" name="name" placeholder="Enter name"
                                value="{{ $profile->name }}" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-form-label">อีเมล</label>
                            <input id="inputEmail" disabled type="email" name="email" placeholder="Enter email"
                                value="{{ $profile->email }}" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">รูป</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                        class="btn btn-primary text-white">
                                        เลือก
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo"
                                    value="{{ $profile->photo }}">
                            </div>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                          <label for="role" class="col-form-label"> บทบาท </label>
                          <select name="role" class="form-control">
                              <option value="">-----เลือกบทบาท-----</option>
                                  <option value="admin" {{(($profile->role=='admin')? 'selected' : '')}}>Admin</option>
                                  <option value="user" {{(($profile->role=='user')? 'selected' : '')}}>User</option>
                          </select>
                        @error('role')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div> --}}

                        <button type="submit" class="btn btn-success btn-sm">อัปเดต</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (isset($seller))

        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-md-12">
                    {{-- @include('backend.layouts.notification') --}}
                </div>
            </div>
            <div class="card-header py-3">
                <h4 class=" font-weight-bold">โปรไฟล์ ผู้ขายสินค้า</h4>
                {{-- <ul class="breadcrumbs">
                    <li><a href="{{ route('admin') }}" style="color:#999">แดชบอร์ด</a></li>
                    <li><a href="" class="active text-primary">หน้าโปรไฟล์</a></li>
                </ul> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="image">
                                @if ($seller->photo)
                                    <img class="card-img-top img-fluid roundend-circle mt-4"
                                        style="border-radius:50%;height:80px;width:80px;margin:auto;"
                                        src="{{ $seller->photo }}" alt="profile picture">
                                @else
                                    <img class="card-img-top img-fluid roundend-circle mt-4"
                                        style="border-radius:50%;height:80px;width:80px;margin:auto;"
                                        src="{{ asset('backend/img/avatar.png') }}" alt="profile picture">
                                @endif
                            </div>
                            <div class="card-body mt-4 ml-2">
                                <h5 class="card-title text-left"><small><i class="fas fa-user"></i>
                                        {{ $seller->name }}</small>
                                </h5>
                                <p class="card-text text-left"><small><i class="fas fa-envelope"></i>
                                        {{ $seller->email }}</small></p>
                                <p class="card-text text-left"><small class="text-muted"><i class="fas fa-hammer"></i>
                                        @if ($seller->role == 'admin')
                                            ผู้ขายสินค้า
                                        @endif
                                    </small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form class="border px-4 pt-2 pb-3" method="POST"
                            action="{{ route('user-cert-update', $seller->id) }}">
                            @csrf
                            <div class="col-12">
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="status">
                                        <div class="status_title">
                                            <label>สถานะการอนุญาติให้ลงขายสินค้า</label>
                                        </div>
                                        @if ($seller->status == 'active')
                                            <li class="text-success">
                                                อนุญาติให้ลงขายสินค้า
                                            </li>
                                        @else
                                            <li class="text-danger">
                                                ไม่อนุญาติให้ลงขายสินค้า
                                            </li>
                                            <span class="text-warning">*</span>
                                            กรุณาตรวจสอบใบอนุญาติการลงขายสินค้า และส่งให้เราตรวจสอบอีกครั้ง
                                        @endif
                                    </div><br>
                                    <label>ใบอนุมัติการลงขายสินค้า</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm1" data-input="thumbnail1" data-preview="holder"
                                                    class="btn btn-primary text-white">
                                                    เลือก
                                                </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="photo_cert"
                                                value="{{ old('photo_cert') }}">
                                        </div>
                                        <div id="holder" class="my-3" style="width: 256px"></div>
                                        @error('photo_cert')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="photo_cert">
                                    รูปภาพใบอนุญาติการลงขายสินค้า
                                </div><br>
                                <div class="row d-flex justify-content-center">
                                    @if ($seller->photo_cert)
                                        @php
                                            $photo = explode(',', $seller->photo_cert);
                                            // dd($photo);
                                        @endphp
                                        <img src="{{ $photo[0] }}" class="img-fluid zoom" style="max-width:256px"
                                            alt="{{ $seller->photo_cert }}">
                                    @else
                                        <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                            style="max-width:256px" alt="avatar.png">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">อัปเดต</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

<style>
    .zoom {
        transition: transform .2s;
        /* Animation */
    }

    .zoom:hover {
        transform: scale(1.8);

    }


    .breadcrumbs {
        list-style: none;
    }

    .breadcrumbs li {
        float: left;
        margin-right: 10px;
    }

    .breadcrumbs li a:hover {
        text-decoration: none;
    }

    .breadcrumbs li .active {
        color: red;
    }

    .breadcrumbs li+li:before {
        content: "/\00a0";
    }

    .image {
        background: url('{{ asset('backend/img/background.jpg') }}');
        height: 150px;
        background-position: center;
        background-attachment: cover;
        position: relative;
    }

    .image img {
        position: absolute;
        top: 55%;
        left: 35%;
        margin-top: 30%;
    }

    i {
        font-size: 14px;
        padding-right: 8px;
    }

</style>

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm1').filemanager('image');

    </script>
@endpush
