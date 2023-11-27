@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card-header">
                <h3>Chi tiết đơn hàng
                    <a href="{{url('admin/orders')}}" class="btn btn-sm btn-primary float-end">Quay lại</a>
                </h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Thông tin đơn hàng</h5>
                        <hr>
                        <p>ID: <strong>{{$order->id}}</strong></p>
                        <p>Mã đơn hàng: <strong>{{$order->tracking_no}}</strong></p>
                        <p>Ngày đặt hàng: <strong>{{$order->created_at->format('H:i:s d-m-Y')}}</strong></p>
                        <p>Tiền thanh toán: <strong>{{number_format($order->paid_money,0,",",".") }}₫</strong></p>
                        <p>Hình thức thanh toán: <strong>@if ($order->payment_mode=='Cash')
                                Thanh toán khi nhận hàng
                                @else
                                Thanh toán PayPal
                                @endif</strong></p>
                        @if ($order->status_message =="Hủy bỏ" || $order->status_message =="Không xử lý")
                        <h6 class="border p-2 text-danger">
                            Trạng thái: {{$order->status_message}}<span></span>
                        </h6>
                        @else
                        <h6 class="border p-2 text-success">
                            Trạng thái: {{$order->status_message}}<span></span>
                        </h6>
                        @endif
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
                                                src="{{asset($orderItem->product->productImages[0]->image)}}" alt="..."
                                                width="70" /></a>
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
                                    <p class="mb-0 small">{{number_format($orderItem->price *
                                        $orderItem->quantity,0,",",".") }}₫</p>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4"><strong>Tổng tiền</strong></td>
                                <td colspan="1">{{number_format($order->total,0,",",".") }}₫</td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong class="text-danger">Mã giảm giá</strong></td>
                                <td colspan="1" class="text-danger">-{{number_format($order->total*$order->discount_value/100,0,",",".") }}₫ ({{$order->discount_value}}%)</td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Thanh toán</strong></td>
                                <td colspan="1">{{number_format($order->paid_money,0,",",".") }}₫</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="{{url('admin/update-status-order/'.$order->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Cập nhật trạng thái</label>
                            <select name="status" id="" class="form-select">
                                <option value="Đang xử lý" {{$order->status_message=="Đang xử lý" ?'selected':''}}>Đang
                                    xử lý</option>
                                <option value="Đang giao hàng" {{$order->status_message=="Đang giao hàng"
                                    ?'selected':''}}>Đang giao hàng</option>
                                <option value="Hoàn thành" {{$order->status_message=="Hoàn thành" ?'selected':''}}>Hoàn
                                    thành</option>
                                <option value="Hủy bỏ" {{$order->status_message=="Hủy bỏ" ?'selected':''}}>Hủy bỏ
                                </option>
                                <option value="Không xử lý" {{$order->status_message=="Không xử lý"
                                    ?'selected':''}}>Không xử lý</option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
