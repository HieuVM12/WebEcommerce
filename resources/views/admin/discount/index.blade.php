@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Quản lý mã giảm giá
                    <a href="{{url('/admin/discounts/create')}}" class="btn btn-sm btn-primary float-end">Thêm mã giảm giá</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Giá trị</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $key=>$discount)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$discount->code}}</td>
                                <td>{{$discount->discount_percentage}}</td>
                                <td>{{ \Carbon\Carbon::parse($discount->valid_from)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($discount->valid_to)->format('d-m-Y') }}</td>
                                <td>{{$discount->status =='1' ? 'Hoạt động':'Không hoạt động'}}</td>
                                <td>
                                    <a href="{{url('admin/discounts/edit/'.$discount->id)}}"class="btn btn-success">Sửa</a>
                                    <a href="{{url('admin/discounts/delete/'.$discount->id)}}" onclick="return confirm('Bạn có chắc xóa mã giảm giá này?')" class="btn btn-danger">Xóa</a>
                                    <a href="{{url('admin/sendCode/'.$discount->id)}}"class="btn btn-primary">Gửi Code</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {!! $discounts->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
