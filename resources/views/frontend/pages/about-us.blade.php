@extends('frontend.layouts.master')

@section('title', 'TopShop || About Us')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">หน้าแรก<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="/about-us">เกี่ยวกับเรา</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- About Us -->
    <section class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="about-content">
                        @php
                            $settings = DB::table('settings')->get();
                        @endphp
                        <h3>ยินดีต้อนรับสู่ <span> TopShop</span></h3>
                        <p>
                            @foreach ($settings as $data) {{ $data->description }}
                            @endforeach
                        </p>
                        <div class="button">
                            <a href="{{ route('blog') }}" class="btn">บล็อกของเรา</a>
                            <a href="{{ route('contact') }}" class="btn">ติดต่อเรา</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-img overlay">
                        {{-- <div class="button">
								<a href="https://www.youtube.com/watch?v=nh2aYrGMrIE" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
							</div> --}}
                        <img src="@foreach ($settings as $data) {{ $data->photo }} @endforeach" alt="                               @foreach ($settings as $data)
                        {{ $data->photo }} @endforeach">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us -->

    <!-- Start Team -->
    <section id="team" class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>ทีมผู้เชี่ยวชาญของเรา</h2>

                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <!-- Single Team -->
                <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center">
                    <div class="single-team" style="width: 260px">
                        <!-- Image -->
                        <div class="image">
                            {{-- <img src="images/team/team1.jpg" alt="#"> --}}
                        </div>
                        <!-- End Image -->
                        <div class="info-head">
                            <!-- Info Box -->
                            <div class="info-box">
                                <h4 class="name"><a href="#">Panuwat Khrai-udom</a></h4>
                                <span class="designation">Full Stack Website Developer</span>
                            </div>
                            <!-- End Info Box -->
                            <!-- Social -->
                            <div class="social-links">
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <!-- End Social -->
                        </div>
                    </div>
                </div>
                <!-- End Single Team -->
                <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center">
                    <div class="single-team" style="width: 260px">
                        <!-- Image -->
                        <div class="image">
                            {{-- <img src="images/team/team2.jpg" alt="#"> --}}
                        </div>
                        <!-- End Image -->
                        <div class="info-head">
                            <!-- Info Box -->
                            <div class="info-box">
                                <h4 class="name"><a href="#">Pherapoj Sunhathum</a></h4>
                                <span class="designation">Editor</span>
                            </div>
                            <!-- End Info Box -->
                            <!-- Social -->
                            <div class="social-links">
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <!-- End Social -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--/ End Team Area -->

    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>ส่งฟรี</h4>
                        <p>สั่งสินค้าขั้นต่ำ $10</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>คืนสินค้าได้ฟรี</h4>
                        <p>ภายใน 30 วันส่งคืน</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>การชำระเงินที่ปลอดภัย</h4>
                        <p>การชำระเงินที่ปลอดภัย 100%</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>ราคาดีที่สุด</h4>
                        <p>รับประกันราคา</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    @include('frontend.layouts.newsletter')
@endsection
