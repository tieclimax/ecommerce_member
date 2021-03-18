@extends('frontend.layouts.master')

@section('title', 'TopShop || Register Page')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">หน้าแรก<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">สมัครสมาชิก</a></li>
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
                        <h2>สมัครสมาชิก</h2>
                        <p>กรุณาลสมัครสมาชิกเพื่อชำระเงินได้รวดเร็วยิ่งขึ้น</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>ชื่อของคุณ<span>*</span></label>
                                        <input type="text" name="name" placeholder="" required="required"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>อีเมลของคุณ<span>*</span></label>
                                        <input type="text" name="email" placeholder="" required="required"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>รหัสผ่านของคุณ
                                            <span>*</span></label>
                                        <input type="password" name="password" placeholder="" required="required"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>ยืนยันรหัสผ่าน<span>*</span></label>
                                        <input type="password" name="password_confirmation" placeholder=""
                                            required="required" value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">สมัครสมาชิก</button>


                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="form-group login-btn">
                                        <span class="text-danger">*</span> <span class="text">หากมีบัญชีอยู่แล้ว</span>
                                        <a href="{{ route('login.form') }}" class="text-success">เข้าสู่ระบบ</a>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
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
