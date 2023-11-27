@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            <h3>Đơn hàng</h3>
        </div>
        <div class="card-body">
            <form action="{{url('admin/orders')}}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Chọn ngày</label>
                        <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Trạng thái</label>
                        <select name="status" id="" class="form-select">
                            <option value="">Chọn trạng thái</option>
                            <option value="Đang xử lý" {{Request::get('status')=="Đang xử lý" ?'selected':''}}>Đang xử lý</option>
                            <option value="Đang giao hàng" {{Request::get('status')=="Đang giao hàng" ?'selected':''}}>Đang giao hàng</option>
                            <option value="Hoàn thành" {{Request::get('status')=="Hoàn thành" ?'selected':''}}>Hoàn thành</option>
                            <option value="Hủy bỏ" {{Request::get('status')=="Hủy bỏ" ?'selected':''}}>Hủy bỏ</option>
                            <option value="Không xử lý" {{Request::get('status')=="Không xử lý" ?'selected':''}}>Không xử lý</option>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <br>
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên người nhận</th>
                        <th>Phương thức thanh toán</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
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
                            @if ($order->status_message =="Hủy bỏ" || $order->status_message =="Không xử lý")
                            <td class="text-danger"><strong>{{$order->status_message}}</strong></td>
                            @else
                            <td class="text-success"><strong>{{$order->status_message}}</strong></td>
                            @endif
                            <td>{{ number_format($order->paid_money,0,",",".") }}₫</td>
                            <td>
                                <a href="{{url('admin/detail-order/'.$order->id)}}" class="btn btn-secondary" style="border-radius: 4px">Chi tiết</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Chưa có đơn hàng nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
