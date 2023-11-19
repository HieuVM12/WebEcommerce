@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Mau sac
                    <a href="{{url('admin/color/create')}}" class="btn btn-sm btn-primary float-end">Them mau sac</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ten mau</th>
                            <th>Code</th>
                            <th>Trang thai</th>
                            <th>Hoat dong</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $key=>$color)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$color->name}}</td>
                                <td>{{$color->code}}</td>
                                <td>{{$color->status=='1'?'Ẩn':'Hiển thị'}}</td>
                                <td>
                                    <a href="{{url('admin/color/'.$color->id.'/edit')}}" class="btn btn-success">Sửa</a>
                                    <a href="{{url('admin/color/'.$color->id.'/delete')}}" onclick="return confirm('Bạn có chắc muốn xóa màu này?')" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>

                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
