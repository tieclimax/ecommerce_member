@extends('frontend.layouts.master')

@section('title', 'TopShop || Login Page')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">หน้าแรก<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">เข้าสู่ระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>เข้าสู่ระบบ</h2>
                        <p>กรุณาลงทะเบียนเพื่อชำระเงินได้รวดเร็วยิ่งขึ้น</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>อีเมลของคุณ<span>*</span></label>
                                        <input type="email" name="email" placeholder="" required="required"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>รหัสผ่านของคุณ<span>*</span></label>
                                        <input type="password" name="password" placeholder="" required="required"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">

                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">เข้าสู่ระบบ</button>

                                    </div>


                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="form-group login-btn">

                                        <span class="text-danger">* </span><span>ยังไม่มีบัญชีใช่ไหม? <a
                                                href="{{ route('register.form') }}"
                                                class="text-danger">สมัครสมาชิก</a></span>

                                    </div>

                                </div>
                                <div class="row my-3">
                                    <div class=" d-flex ml-4">
                                        {{-- <div class="checkbox"> --}}
                                        <label class="checkbox-inline"><input name="news" id="2" type="checkbox"
                                                class="mr-2">จดจำฉัน</label>
                                        {{-- </div> --}}
                                    </div>
                                    <div class=" d-flex justify-content-end">
                                        <div class="resetpassword">
                                            @if (Route::has('password.request'))
                                                <a class="lost-pass" href="{{ route('password.reset') }}">
                                                    ลืมรหัสผ่าน?
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--/ End Form -->

                    </div>
                </div>
            </div>
    </section>
    <!--/ End Login -->
@endsection
@push('styles')
    <style>
        .shop.login .form .btn {
            margin-right: 0;
        }

        .btn-facebook {
            background: #39579A;
        }

        .btn-facebook:hover {
            background: #073088 !important;
        }

        .btn-github {
            background: #444444;
            color: white;
        }

        .btn-github:hover {
            background: black !important;
        }

        .btn-google {
            background: #ea4335;
            color: white;
        }

        .btn-google:hover {
            background: rgb(243, 26, 26) !important;
        }

    </style>
@endpush
