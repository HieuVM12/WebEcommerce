@extends('layouts.frontend')

@section('content')
<div class="container">
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Đơn hàng của tôi</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/index')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/orders')}}">Đơn hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4>Chi tiết đơn hàng</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Thông tin đơn hàng</h5>
                                <hr>
                                <p>ID: <strong>{{$order->id}}</strong></p>
                                <p>Mã đơn hàng: <strong>{{$order->tracking_no}}</strong></p>
                                <p>Ngày đặt hàng: <strong>{{$order->created_at->format('H:i:s d-m-Y')}}</strong></p>
                                <p>Tiền thanh toán: <strong>{{number_format($order->total,0,",",".") }}₫</strong></p>
                                <p>Hình thức thanh toán: <strong>@if ($order->payment_mode=='Cash')
                                    Thanh toán khi nhận hàng
                                @else
                                    Thanh toán PayPal
                                @endif</strong></p>
                                <h6 class="border p-2 text-success">
                                    Trạng thái: {{$order->status_message}}<span></span>
                                </h6>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <h5>Thông tin người nhận</h5>
                                <hr>
                                <p>Họ tên: <strong>{{$order->fullname}}</strong></p>
                                <p>Email: <strong>{{$order->email}}</strong></p>
                                <p>Số điện thoại: <strong>{{$order->phone}}</strong></p>
                                <p>Địa chỉ giao hàng: <strong>{{$order->address}}</strong></p>
                                <p>Địa chỉ giao hàng 2: <strong>{{$order->address2}}</strong></p>
                                <hr>
                            </div>
                        </div>
                        <br>
                        <h5>Sản phẩm đặt hàng</h5>
                        <hr>
                        <div class="table-responsive mb-4">
                            <table class="table text-nowrap">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Sản
                                                phẩm</strong></th>
                                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Đơn giá
                                            </strong></th>
                                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Màu
                                            </strong></th>
                                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Số
                                                lượng</strong></th>
                                        <th class="border-0 p-3" scope="col"> <strong
                                                class="text-sm text-uppercase">Tổng</strong></th>

                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @foreach ($order->orderItems as $orderItem)
                                    <tr>
                                        <th class="ps-0 py-3 border-light" scope="row">
                                            <div class="d-flex align-items-center"><a
                                                    class="reset-anchor d-block animsition-link"
                                                    href="{{url('/product/'.$orderItem->product->slug)}}"><img
                                                        src="{{asset($orderItem->product->productImages[0]->image)}}"
                                                        alt="..." width="70" /></a>
                                                <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link"
                                                            href="{{url('/product/'.$orderItem->product->slug)}}">{{$orderItem->product->name}}</a></strong>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0 small">{{
                                                number_format($orderItem->price,0,",",".") }}₫</p>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0 small">{{$orderItem->productColor->color->name}}</p>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0 small">{{$orderItem->quantity}}</p>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0 small">{{number_format($orderItem->price * $orderItem->quantity,0,",",".") }}₫</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4"><strong>Tổng tiền</strong></td>
                                        <td colspan="1">{{number_format($order->total,0,",",".") }}₫</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
