@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Danh muc san pham
                    <a href="{{url('admin/category/create')}}" class="btn btn-sm btn-primary float-end">Them danh muc</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ten danh muc</th>
                            <th>Danh muc cha</th>
                            <th>Trang thai</th>
                            <th>Hoat dong</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key=>$category)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                @if ($category->parent_id == '0')
                                    <td>0</td>
                                @else
                                    @foreach ($categories as $category1)
                                        @if ($category1->id == $category->parent_id)
                                            <td>{{$category1->name}}</td>
                                        @endif
                                    @endforeach
                                @endif
                                <td>{{$category->status =='1' ? 'An':'Hoat dong'}}</td>
                                <td>
                                    <a href="{{url('admin/category/'.$category->id.'/edit')}}"class="btn btn-success">Sua</a>
                                    <a href="{{url('admin/category/'.$category->id.'/delete')}}" onclick="return confirm('Ban co chac muon xoa danh muc nay?')" class="btn btn-danger">Xoa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection