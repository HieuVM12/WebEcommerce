@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Quan li san pham
                    <a href="{{url('admin/product/create')}}" class="btn btn-sm btn-primary float-end">Them san pham</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Danh muc</th>
                            <th>Ten san pham</th>
                            <th>Gia ban</th>
                            <th>So luong</th>
                            <th>Trang thai</th>
                            <th>Hanh dong</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status == '1' ?'An' : 'Dang hoat dong'}}</td>
                                <td>
                                    <a href="{{url('/admin/product/'.$product->id.'/edit')}}" class="btn btn-primary">Sua</a>
                                    <a href="{{url('/admin/product/'.$product->id.'/delete')}}" onclick="return confirm('Ban co chac muon xoa san pham nay?')" class="btn btn-danger">Xoa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
