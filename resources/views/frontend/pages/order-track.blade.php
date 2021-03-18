@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Order Track Page')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">หน้าแรก<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">ติดตามสินค้า</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <section class="tracking_box_area section_gap py-5">
        <div class="container">
            <div class="tracking_box_inner">
                <p>หากต้องการติดตามคำสั่งซื้อของคุณโปรดป้อนรหัสคำสั่งซื้อของคุณในช่องด้านล่างและกดปุ่ม "ติดตาม"
                    สิ่งนี้ได้รับถึงคุณในใบเสร็จรับเงินและในอีเมลยืนยันที่คุณควรได้รับ</p>
                <form class="row tracking_form my-4" action="{{ route('product.track.order') }}" method="post"
                    novalidate="novalidate">
                    @csrf
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control p-2" name="order_number"
                            placeholder="ป้อนหมายเลขคำสั่งซื้อของคุณ">
                    </div>
                    <div class="col-md-8 form-group">
                        <button type="submit" value="submit" class="btn submit_btn">ติดตามสินค้า</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
