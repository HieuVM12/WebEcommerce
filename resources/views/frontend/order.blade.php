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
                            <li class="breadcrumb-item active" aria-current="page">Đơn hàng của tôi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- HERO SECTION-->
    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">Đơn hàng của tôi</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhận</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $key=>$order)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->tracking_no}}</td>
                                        <td>{{$order->fullname}}</td>
                                        <td>
                                            @if ($order->payment_mode=='Cash')
                                            Thanh toán khi nhận hàng
                                            @endif
                                            @if ($order->payment_mode=='PayPal')
                                            Thanh toán Paypal
                                            @endif
                                        </td>
                                        <td>
                                            {{$order->created_at->format('H:i:s d-m-Y')}}
                                        </td>
                                        <td>{{$order->status_message}}</td>
                                        <td>
                                            <a href="{{url('/detail-order/'.$order->id)}}" class="btn btn-secondary" style="border-radius: 4px">Xem chi tiết</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <h4>Bạn chưa có đơn hàng nào</h4>
                                    @endforelse
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
