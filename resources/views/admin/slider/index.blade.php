@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Sliders
                    <a href="{{url('admin/slider/create')}}" class="btn btn-sm btn-primary float-end">Them slider</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $key=>$slider)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$slider->title}}</td>
                                <td>
                                    @if (isset($slider->image))
                                    <img src="{{asset('uploads/slider/'.$slider->image)}}" alt="">
                                    @endif
                                </td>
                                <td>{{$slider->status=='1' ? 'Không hiển thị':'Hiển thị'}}</td>
                                <td>
                                    <a href="{{url('admin/slider/'.$slider->id.'/edit')}}"class="btn btn-success">Sửa</a>
                                    <a href="{{url('admin/slider/'.$slider->id.'/delete')}}" onclick="return confirm('Bạn có chắc muốn xóa slide này?')" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
