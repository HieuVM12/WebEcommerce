@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Quản lý người dùng
                    <a href="{{url('admin/product/create')}}" class="btn btn-sm btn-primary float-end">Thêm người dùng</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=>$user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_as=='1'?'Admin':'Khách hàng'}}</td>
                                <td>
                                    @if ($user->role_as==0 || $user->id == auth()->user()->id)
                                    <a href="{{url('admin/users/edit/'.$user->id)}}" class="btn btn-success">Sửa</a>
                                    <a href="{{url('admin/users/delete/'.$user->id)}}" onclick="return confirm('Bạn có chắc muốn xóa người dùng này này?')" class="btn btn-danger">Xóa</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
