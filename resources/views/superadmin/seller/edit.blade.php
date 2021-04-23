@extends('superadmin.layouts.master')

@section('title', 'Confirm Product Detail')

@section('main-content')
    <div class="card">
        <h5 class="card-header">รายละเอียดผู้ลงทะเบียนขายสินค้า
            {{-- <form method="post" action="{{ route('seller-management.update', [$seller->id]) }}">
                @csrf
                @method('put')
                <button class="btn btn-success btn-sm float-right" data-id={{ $seller->id }} data-toggle="tooltip"
                    title="Confirm" data-placement="bottom"><i class="fas fa-plus"></i> อนุมัติสินค้า</button>
            </form> --}}

        </h5>
        <div class="card-body">
            @if ($seller)

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                <div class="order-info">
                                    <h4 class="text-center pb-4"> ข้อมูลผู้ใช้</h4>
                                    <table class="table">

                                        <tr class="">
                                            <td> หมายเลขผู้ใช้ </td>
                                            <td> : {{ $seller->id }}</td>
                                        </tr>
                                        <tr>
                                            <td> วันที่ลงทะเบียน </td>
                                            <td> : {{ $seller->created_at->format('D d M, Y') }} at
                                                {{ $seller->created_at->format('g : i a') }} </td>
                                        </tr>
                                        <tr>
                                            <td> ชื่อผู้ใช้ </td>
                                            <td> : {{ $seller->name }}</td>
                                        </tr>
                                        <tr>
                                            <td> อีเมล </td>
                                            <td> : {{ $seller->email }}</td>
                                        </tr>
                                        <tr>
                                            <td> บทบาท </td>
                                            @if ($seller->role == 'admin')
                                                <td> : ผู้ขายสินค้า</td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td> สถานะ </td>
                                            @if ($seller->status == 'pending')
                                                <td> : รอการดำเนินการ</td>
                                            @elseif ($seller->status == 'inactive')
                                                <td> : ไม่อนุมัติ</td>
                                            @else
                                                <td> : อนุมัติ</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td> การอนุมัติ </td>
                                            <td>
                                                <form action="{{ route('seller-management.update', [$seller->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-success" value="active"
                                                        name="status">อนุมัติ</button>
                                                    <button type="submit" class="btn btn-danger" value="inactive"
                                                        name="status">ไม่อนุมัติ</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4"> ใบอนุญาติการขายสินค้าโอทอป</h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>
                                                @if ($seller->photo_cert)
                                                    @php
                                                        $photo = explode(',', $seller->photo_cert);
                                                        // dd($photo);
                                                    @endphp
                                                    @foreach ($photo as $key => $item)
                                                        <img src="{{ $photo[$key] }}" class="mb-4" style="max-width:512px"
                                                            alt="{{ $seller->phophoto_certto }}">
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
