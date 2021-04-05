@extends('user.layouts.master')

@section('title', 'Order Detail')
    <link rel="icon" type="image/png" href="images/icons/ecommerce.png">
@section('main-content')
    <div class="card">
        <h5 class="card-header">คำสั่งซื้อ
            {{-- <a href="{{ route('order.pdf', $order->id) }}"
                class=" btn btn-sm btn-primary shadow-sm float-right">
                <i class="fas fa-download fa-sm text-white-50"></i> สร้าง PDF</a> --}}
        </h5>
        <div class="card-body">
            @if ($order)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th> หมายเลขคำสั่งซื้อ </th>
                            <th>ชื่อ</th>
                            <th>อีเมล</th>
                            <th> ปริมาณ </th>
                            <th>ค่าบริการเพิ่มเติม</th>
                            <th> จำนวนเงินทั้งหมด </th>
                            <th>สถานะ</th>
                            <th> การกระทำ </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @php
                                $shipping_charge = DB::table('shippings')
                                    ->where('id', $order->shipping_id)
                                    ->pluck('price');
                            @endphp
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>
                                @foreach ($shipping_charge as $data) $
                                    {{ number_format($data, 2) }} @endforeach
                            </td>
                            <td>฿{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @if ($order->status == 'new')
                                    <span class="badge badge-primary">{{ $order->status }}</span>
                                @elseif($order->status=='process')
                                    <span class="badge badge-warning">{{ $order->status }}</span>
                                @elseif($order->status=='delivered')
                                    <span class="badge badge-success">{{ $order->status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('order.destroy', [$order->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn" data-id={{ $order->id }}
                                        style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                        data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>

                        </tr>
                    </tbody>
                </table>

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                <div class="order-info">
                                    <h4 class="text-center pb-4"> ข้อมูลการสั่งซื้อ </h4>
                                    <table class="table">
                                        <tr class="">
                                            <td> หมายเลขคำสั่งซื้อ </td>
                                            <td> : {{ $order->order_number }}</td>
                                        </tr>
                                        <tr>
                                            <td> วันที่สั่งซื้อ </td>
                                            <td> : {{ $order->created_at->format('D d M, Y') }} at
                                                {{ $order->created_at->format('g : i a') }} </td>
                                        </tr>
                                        <tr>
                                            <td> ปริมาณ </td>
                                            <td> : {{ $order->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td> สถานะการสั่งซื้อ </td>
                                            <td> : {{ $order->status }}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $shipping_charge = DB::table('shippings')
                                                    ->where('id', $order->shipping_id)
                                                    ->pluck('price');
                                            @endphp
                                            <td> ค่าจัดส่ง </td>
                                            <td> : $ {{ number_format($shipping_charge[0], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td> จำนวนเงินทั้งหมด </td>
                                            <td> : $ {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td> วิธีการชำระเงิน </td>
                                            <td> : @if ($order->payment_method == 'cod')
                                                เก็บเงินปลายทาง @else Paypal @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> สถานะการชำระเงิน </td>
                                            <td> : {{ $order->payment_status }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4"> ข้อมูลการจัดส่ง </h4>
                                    <table class="table">
                                        <tr class="">
                                            <td> ชื่อนามสกุล </td>
                                            <td> : {{ $order->first_name }} {{ $order->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>อีเมล</td>
                                            <td> : {{ $order->email }}</td>
                                        </tr>
                                        <tr>
                                            <td> เบอร์โทรศัพท์ </td>
                                            <td> : {{ $order->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>ที่อยู่</td>
                                            <td> : {{ $order->address1 }}, {{ $order->address2 }}</td>
                                        </tr>
                                        <tr>
                                            <td>ประเทศ</td>
                                            <td> : {{ $order->country }}</td>
                                        </tr>
                                        <tr>
                                            <td> รหัสไปรษณีย์ </td>
                                            <td> : {{ $order->post_code }}</td>
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
