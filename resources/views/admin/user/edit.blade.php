@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Sửa thông tin người dùng
                    <a href="{{url('admin/users')}}" class="btn btn-sm btn-danger float-end">Quay lại</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <small class="text-danger">{{$error}}</small><br>
                    @endforeach
                @endif
                <form action="{{url('admin/users/update/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label>Họ tên</label>
                            <input type="text" name="name" id="" class="form-control" required value="{{$user->name}}">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Email</label>
                            <input type="text" name="email" id="" class="form-control" required value="{{$user->email}}">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Quyền</label>
                            <input type="checkbox" name="role_as" id="" {{$user->role_as=='1'?'checked':''}}>
                        </div>

                        <div class="mb-3 col-md-12">
                            <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
