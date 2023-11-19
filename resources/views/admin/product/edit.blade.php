@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>Cap nhat san pham
                <a href="{{url('admin/product')}}" class="btn btn-sm btn-danger float-end">Quay lai</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{url('admin/product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Thong tin</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="false">Tags</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane"
                            aria-selected="false">Thong so</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane"
                            type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Anh san
                            pham</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane"
                            type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">Màu sản
                            phẩm</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade border p3 show active" id="home-tab-pane" role="tabpanel"
                        aria-labelledby="home-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Danh muc</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$product->category_id==$category->id ? 'selected' :
                                    ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Ten san pham</label>
                            <input type="text" value="{{$product->name}}" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label>Tom tat san pham</label>
                            <textarea name="small_description" id="" rows="4"
                                class="form-control">{{$product->small_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Mo ta san pham</label>
                            <textarea name="description" id="" rows="4"
                                class="form-control">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p3" id="profile-tab-pane" role="tabpanel"
                        aria-labelledby="profile-tab" tabindex="0">
                        <div class="mb-3">
                            <label>Tieu de Meta</label>
                            <input type="text" class="form-control" name="meta_title" value="{{$product->meta_title}}">
                        </div>
                        <div class="mb-3">
                            <label>Tu khoa Meta</label>
                            <textarea name="meta_keyword" id="" rows="4"
                                class="form-control">{{$product->meta_keyword}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Mo ta Meta</label>
                            <textarea name="meta_description" id="" rows="4"
                                class="form-control">{{$product->meta_description}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p3" id="contact-tab-pane" role="tabpanel"
                        aria-labelledby="contact-tab" tabindex="0">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Gia goc</label>
                                <input type="text" name="original_price" value="{{$product->original_price}}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Gia ban</label>
                                <input type="text" name="selling_price" value="{{$product->selling_price}}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">So luong</label>
                                <input type="number" name="quantity" value="{{$product->quantity}}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Trang thai</label>
                                <input type="checkbox" name="status" {{$product->status=='1'?'checked':''}}>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Trending</label>
                                <input type="checkbox" name="trending" {{$product->trending=='1'?'checked':''}}>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                        tabindex="0">
                        <div class="mb-3">
                            <label for="">Upload anh san pham</label>
                            <input type="file" name="image[]" class="form-control" multiple>
                            @if ($product->productImages!=null)
                            <div class="row">

                                @foreach ($product->productImages as $image)
                                <div class="col-md-2">
                                    <img src="{{asset($image->image)}}" class="me-4 border" alt="" width="150px"
                                        height="200px">
                                    <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block">Xoa
                                        anh</a>
                                </div>
                                @endforeach
                            </div>

                            @endif
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
                                        <input type="checkbox" name="colors[{{$color->id}}]"
                                            value="{{$color->id}}">{{$color->name}}
                                        <br>
                                        Quantity: <input type="number" name="color_quantity[{{$color->id}}]"
                                            style="width: 70px; border: 1px solid">
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên màu</th>
                                        <th>Số lượng</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->productColors as $prodColor)
                                    <tr class="prod-color-tr">
                                        <td>{{$prodColor->color->name}}</td>
                                        <td>
                                            <div style="width: 150px" class="input-group mb-3">
                                                <input type="text" value="{{$prodColor->quantity}}"
                                                    class="productColorQuantity form-control form-control-sm">
                                                <button type="button" value="{{$prodColor->id}}"
                                                    class="updateProductColorBtn btn btn-primary btn-sm text-white">Cập
                                                    nhật</button>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" value="{{$prodColor->id}}"
                                                class="deleteProductColorBtn btn btn-danger btn-sm text-white">Xóa</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary float-end">Cap nhat</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.updateProductColorBtn', function(){
            var prod_color_id = $(this).val();
            var product_id="{{$product->id}}";
            var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
            if(qty<=0){
                alert('Nhập số lượng hợp lệ');
                return false;
            }
            var data = {
                'product_id':product_id,
                'qty':qty
            };

            $.ajax({
                type:"POST",
                url:"/admin/product-color/"+prod_color_id,
                data: data,
                success: function(response){
                    alert(response.message)
                }
            });
        });
        $(document).on('click', '.deleteProductColorBtn', function(){
            var prod_color_id = $(this).val();
            var thisClick = $(this);
            $.ajax({
                type:"GET",
                url:"/admin/product-color/"+prod_color_id+"/delete",
                success: function(response){
                    thisClick.closest('.prod-color-tr').remove();
                    alert(response.message);
                }

            });
        });

    });
</script>
@endsection
