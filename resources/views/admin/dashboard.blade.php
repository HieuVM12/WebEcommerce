@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="me-md-3 me-xl-5">
            <h2>Welcome back,</h2>
            <p class="mb-md-0">Your analytics dashboard template.</p>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>Tổng đơn hàng</label>
                    <h1>{{$totalOrder}}</h1>
                    <a href="{{url('admin/orders/')}}" class="text-white">Xem</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Đơn hàng hôm nay </label>
                    <h1>{{$todayOrder}}</h1>
                    <a href="{{url('admin/orders/')}}" class="text-white">Xem</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>Đơn hàng tháng này</label>
                    <h1>{{$monthOrder}}</h1>
                    <a href="{{url('admin/orders/')}}" class="text-white">Xem</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <label>Đơn hàng năm nay</label>
                    <h1>{{$yearOrder}}</h1>
                    <a href="{{url('admin/orders/')}}" class="text-white">Xem</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
