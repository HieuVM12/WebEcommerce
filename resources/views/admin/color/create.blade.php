@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm màu sắc
                    <a href="{{url('admin/color')}}" class="btn btn-sm btn-danger float-end">Quay lai</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())

                    @foreach ($errors->all() as $error)
                        <small class="text-danger">{{$error}}</small><br>
                    @endforeach

                @endif
                <form action="{{url('admin/color/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label>Tên màu</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Code</label>
                            <input type="text" name="code" id="" class="form-control">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Trang thai</label>
                            <input type="checkbox" name="status" id="">
                        </div>
                        <div class="mb-3 col-md-12">
                            <button type="submit" class="btn btn-primary float-end">Lưu</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
