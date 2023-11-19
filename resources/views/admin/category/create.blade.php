@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Them danh muc 
                    <a href="{{url('admin/category')}}" class="btn btn-sm btn-danger float-end">Quay lai</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                
                    @foreach ($errors->all() as $error)
                        <small class="text-danger">{{$error}}</small><br>
                    @endforeach
                
                @endif
                <form action="{{url('admin/category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label>Ten danh muc</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Mo ta</label>
                            <textarea name="description" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Danh Mục Cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">0</option>
                                @foreach($categories as $item)
                                        <option value="{{ $item->id }}" {{old('parent_id')==$item->id?'selected':''}}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Anh</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Trang thai</label>
                            <input type="checkbox" name="status" id="">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Tiêu đề Meta</label>
                            <input type="text" name="meta_title" id="" class="form-control">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Tu khoa Meta</label>
                            <textarea name="meta_keyword" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Mo ta Meta</label>
                            <textarea name="meta_description" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3 col-md-12">
                            <button type="submit" class="btn btn-primary float-end">Luu</button>
                        </div>
                    </div>
                    

                </form>
            </div>
        </div>
    </div>
@endsection