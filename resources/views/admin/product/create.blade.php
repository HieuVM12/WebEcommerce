@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>Thêm sản phẩm
                <a href="{{url('admin/product')}}" class="btn btn-sm btn-danger float-end">Quay lại</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{url('admin/product/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Thông tin</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="false">Tags</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane"
                            aria-selected="false">Thông số</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                            data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane"
                            aria-selected="false">Ảnh sản phẩm</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                            data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane"
                            aria-selected="false">Màu sản phẩm</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade border p3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <div class="mb-3">
                            <label>Danh mục</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label>Tóm tắt sản phẩm</label>
                            <textarea name="small_description" id="" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Mô tả sản phẩm</label>
                            <textarea name="description" id="" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p3" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <div class="mb-3">
                            <label>Tiêu đề Meta</label>
                            <input type="text" class="form-control" name="meta_title">
                        </div>
                        <div class="mb-3">
                            <label>Từ khóa Meta</label>
                            <textarea name="meta_keyword" id="" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Mô tả Meta</label>
                            <textarea name="meta_description" id="" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p3" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                        tabindex="0">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Giá gốc</label>
                                <input type="text" name="original_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Giá bán</label>
                                <input type="text" name="selling_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Số lượng</label>
                                <input type="number" name="quantity" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Trạng thái</label>
                                <input type="checkbox" name="status">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Trending</label>
                                <input type="checkbox" name="trending">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                        tabindex="0">
                        <div class="mb-3">
                            <label for="">Upload ảnh sản phẩm</label>
                            <input type="file" name="image[]"  class="form-control" multiple>
                        </div>
                    </div>
                    <div class="tab-pane fade border p3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab"
                        tabindex="0">
                        <div class="mb-3">
                            <label for="">Chọn màu</label>
                            <div class="row">
                                @foreach ($colors as $color)
                                <div class="col-md-3">
                                    <div class="p-2 border mb-3">
                                    <input type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}" >{{$color->name}}
                                    <br>
                                    Số lượng: <input type="number" name="color_quantity[{{$color->id}}]" style="width: 70px; border: 1px solid">
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary float-end">Thêm sản phẩm</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
