@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Sửa slide
                    <a href="{{url('admin/slider')}}" class="btn btn-sm btn-danger float-end">Quay lại</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())

                    @foreach ($errors->all() as $error)
                        <small class="text-danger">{{$error}}</small><br>
                    @endforeach

                @endif
                <form action="{{url('admin/slider/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" id="" class="form-control" required value="{{$slider->title}}">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Mô tả</label>
                            <textarea name="description" id="" rows="3" class="form-control" required>{{$slider->description}}</textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Ảnh</label>
                            <input type="file" name="image" id="" class="form-control">
                            @if(isset($slider->image))
                                <img src="{{asset('uploads/slider/'.$slider->image)}}" width="600px" height="400px" alt="">
                            @endif
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Trạng thái</label>
                            <input type="checkbox" name="status" id="" {{$slider->status=='1'?'checked':''}}>
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
