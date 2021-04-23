@extends('frontend.layouts.master')

@section('title', 'TopShop || Register Seller Page')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">หน้าแรก<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">ขายสินค้ากับท็อปช็อป</a></li>
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
                        <h2>เริ่มต้นธุรกิจของคุณบน TopShop</h2>
                        <p>บุคคลจะต้องมีบัตรประจำตัวที่ออกโดยรัฐบาลที่ถูกต้องซึ่งแสดงสัญชาติและวันเกิดและต้องมีอายุอย่างน้อย
                            18 ปีจึงจะสามารถขายในฐานะบุคคลธรรมดาบน Topshop ได้</p>
                        <p class="text-danger">
                            บุคคลจะต้องได้รับการอนุญาติจากผู้มีอำนาจในการเซ็นอนุมัติประจำหมู่บ้านเพื่อยืนยันการเป็นตัวแทนในการขายสินค้าโอทอป
                        </p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('register.seller.submit') }}">
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
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>ใบอนุมัติการลงขายสินค้า<span>*</span></label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary text-white">
                                                        เลือก
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control" type="text" name="photo_cert"
                                                    value="{{ old('photo_cert') }}">
                                            </div>
                                            <div id="holder" class="my-3" style="width: 256px"></div>
                                            @error('photo_cert')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <span class="text-danger">* </span><label>การกดสมัครสมาชิก, คุณยอมรับข้อตกลงของเรา
                                            <a href={{ route('register.seller.policy') }} target="_blank"
                                                class="text-primary" rel="noopener noreferrer">ข้อตกลงและเงื่อนไข</a>
                                        </label>
                                        <input type="hidden" name="status" placeholder="" value="inactive">

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
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
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
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $('#lfm').filemanager('image');

    </script>
@endpush
