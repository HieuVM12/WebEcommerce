@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Slider
                    <a href="{{url('admin/slider')}}" class="btn btn-sm btn-danger float-end">Quay lại</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())

                    @foreach ($errors->all() as $error)
                        <small class="text-danger">{{$error}}</small><br>
                    @endforeach

                @endif
                <form action="{{url('admin/slider/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Mô tả</label>
                            <textarea name="description" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Ảnh</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Trạng thái</label>
                            <input type="checkbox" name="status" id="">
                        </div>

                        <div class="mb-3 col-md-12">
                            <button type="submit" class="btn btn-primary float-end">Thêm</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
