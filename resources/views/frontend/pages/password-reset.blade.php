@extends('frontend.layouts.master')

@section('title', 'TopShop || Reset Password Page')

@section('main-content')
    <section class="shop login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>รีเซ็ทรหัสผ่าน</h2>
                        <p>กรุณาใส่อีเมลของคุณเพื่อรับข้อความการรีเซ็ตรหัสผ่าน</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('resetpassword.sent') }}">
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

                                <div class="col-6">
                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">ยืนยัน</button>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--/ End Form -->

                    </div>
                </div>
            </div>
    </section>

@endsection
