@extends('superadmin.layouts.master')

@section('title', 'Confirm Product Detail')

@section('main-content')
    <div class="card">
        <h5 class="card-header">รายละเอียดสินค้า
            <form method="post" action="{{ route('product-management.update', [$product->id]) }}">
                @csrf
                @method('put')
                <button class="btn btn-success btn-sm float-right" data-id={{ $product->id }} data-toggle="tooltip"
                    title="Confirm" data-placement="bottom"><i class="fas fa-plus"></i> อนุมัติสินค้า</button>
            </form>

        </h5>
        <div class="card-body">
            @if ($product)

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                <div class="order-info">
                                    <h4 class="text-center pb-4"> ข้อมูลสินค้า </h4>
                                    <table class="table">
                                        @php
                                            $sub_cat_info = DB::table('categories')
                                                ->select('title')
                                                ->where('id', $product->child_cat_id)
                                                ->get();
                                            // dd($sub_cat_info);
                                            $brands = DB::table('brands')
                                                ->select('title')
                                                ->where('id', $product->brand_id)
                                                ->get();
                                            $owners = DB::table('users')
                                                ->select('name')
                                                ->where('id', $product->owner_id)
                                                ->get();
                                        @endphp
                                        <tr class="">
                                            <td> หมายเลขสินค้า </td>
                                            <td> : {{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <td> วันที่ลงสินค้า </td>
                                            <td> : {{ $product->created_at->format('D d M, Y') }} at
                                                {{ $product->created_at->format('g : i a') }} </td>
                                        </tr>
                                        <tr>
                                            <td> ชื่อสินค้า </td>
                                            <td> : {{ $product->title }}</td>
                                        </tr>
                                        <tr>
                                            <td> คำอธิบายสั้น </td>
                                            <td> : {{ $product->summary }}</td>
                                        </tr>
                                        <tr>
                                            <td> คำอธิบายสยาว </td>
                                            <td> : {{ $product->description }}</td>
                                        </tr>
                                        <tr>
                                            <td> สถานะ </td>
                                            <td> : {{ $product->status }}</td>
                                        </tr>
                                        <tr>
                                            <td>สินค้าในคลัง</td>
                                            <td> : {{ number_format($product->stock) }}</td>
                                        </tr>
                                        <tr>
                                            <td> ราคาต่อชิ้น </td>
                                            <td> : ฿ {{ number_format($product->price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td> ขนาด </td>
                                            <td> : {{ $product->size }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> เงื่อนไขสินค้า </td>
                                            <td> : {{ $product->condition }}</td>
                                        </tr>
                                        <tr>
                                            <td> กำลังมาแรง </td>
                                            @if ($product->is_featured == 1)
                                                <td> : ใช่</td>
                                            @else <td> : ไม่ใช่</td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td> ส่วนลด </td>
                                            @if ($product->discount == null)
                                                <td> : ไม่มีส่วนลด</td>
                                            @else <td> : {{ $product->discount }}</td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td> หมวดหมู่ </td>
                                            <td>: {{ $product->cat_info['title'] }}
                                                <sub>
                                                    @foreach ($sub_cat_info as $data)
                                                        - {{ $data->title }}
                                                    @endforeach
                                                </sub>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> ยี่ห้อ </td>
                                            @if ($product->brand_id == null)
                                                <td>: ไม่มียี่ห้อ</td>
                                            @endif
                                            @foreach ($brands as $brand)
                                                <td>: {{ $brand->title }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td> ผู้ลงขายสินค้า </td>

                                            @foreach ($owners as $owner)
                                                <td>: {{ $owner->name }}</td>
                                            @endforeach
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4"> รูปภาพสินค้า </h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>
                                                @if ($product->photo)
                                                    @php
                                                        $photo = explode(',', $product->photo);
                                                        // dd($photo);
                                                    @endphp
                                                    @foreach ($photo as $key => $item)
                                                        <img src="{{ $photo[$key] }}" class="mb-4"
                                                            style="max-width:512px" alt="{{ $product->photo }}">
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('backend/img/thumbnail-default.jpg') }}"
                                                        class="img-fluid" style="max-width:512px" alt="avatar.png">
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,
        .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4,
        .shipping-info h4 {
            text-decoration: underline;
        }

    </style>
@endpush
