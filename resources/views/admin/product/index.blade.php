@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Quản lý sản phẩm
                    <a href="{{url('admin/product/create')}}" class="btn btn-sm btn-primary float-end">Thêm sản phẩm</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Danh mục</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{number_format($product->selling_price,0,",",".") }}₫</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status == '1' ?'Không hiển thị' : 'Hiển thị'}}</td>
                                <td>
                                    <a href="{{url('/admin/product/'.$product->id.'/edit')}}" class="btn btn-primary">Sửa</a>
                                    <a href="{{url('/admin/product/'.$product->id.'/delete')}}" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
