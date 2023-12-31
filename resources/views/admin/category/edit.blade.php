@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cập nhật danh mục
                    <a href="{{url('admin/category')}}" class="btn btn-sm btn-danger float-end">Quay lại</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())

                    @foreach ($errors->all() as $error)
                        <small class="text-danger">{{$error}}</small><br>
                    @endforeach

                @endif
                <form action="{{url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label>Tên danh mục</label>
                            <input type="text" name="name" id="" class="form-control" value="{{$category->name}}">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Mô tả</label>
                            <textarea name="description" id="" rows="3" class="form-control">{{$category->description}}</textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Danh Mục Lớn</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">0</option>
                                @foreach($categories as $item)
                                    @if ($item->id != $category->id)
                                        <option value="{{ $item->id}}" {{$category->parent_id == $item->id ? 'selected':''}}>{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Ảnh</label>
                            <input type="file" name="image" id="" class="form-control">
                            <img src="{{asset('uploads/category/'.$category->image)}}" style="width: 300px; height:300px" alt="">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Trạng thái</label>
                            <input type="checkbox" name="status" id="" {{$category->status=='1'?'checked':''}}>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Tiêu đề Meta</label>
                            <input type="text" name="meta_title" id="" class="form-control" value="{{$category->meta_title}}">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Từ khóa Meta</label>
                            <textarea name="meta_keyword" id="" rows="3" class="form-control">{{$category->meta_keyword}}</textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Mô tả Meta</label>
                            <textarea name="meta_description" id="" rows="3" class="form-control">{{$category->meta_description}}</textarea>
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
