@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Sửa mã giảm giá
                <a href="{{url('admin/discounts')}}" class="btn btn-sm btn-danger float-end">Quay lại</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{url('admin/discounts/update/'.$discount->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label>Code</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{$discount->code}}" required>
                        <button type="button" id="generateCodeButton" class="btn btn-primary">Tạo mã random</button>
                        @error('code')
                        <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label>Giá trị mã</label>
                        <input type="number" name="discount_percentage" id="" class="form-control" value="{{$discount->discount_percentage}}" required>
                        @error('discount_percentage')
                        <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label>Ngày bắt đầu</label>
                        <input type="date" name="valid_from" id="" class="form-control" value="{{$discount->valid_from}}" required>
                        @error('valid_from')
                        <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label>Ngày kết thúc</label>
                        <input type="date" name="valid_to" id="" class="form-control" value="{{$discount->valid_to}}" required>
                        @error('valid_to')
                        <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label>Mô tả</label>
                        <textarea name="description" id="" rows="3" class="form-control" required>{{$discount->description}}</textarea>
                        @error('description')
                        <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label>Trạng thái</label>
                        <input type="checkbox" name="status" id="" {{$discount->status==1?'checked':''}}>
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

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to generate a random code
        function generateRandomCode(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                result += characters.charAt(randomIndex);
            }
            return result;
        }

        // Event listener for the button click
        document.getElementById('generateCodeButton').addEventListener('click', function () {
            // Generate a random code with a length of 10
            const randomCode = generateRandomCode(10);
            // Set the generated code to the input field
            document.getElementById('code').value = randomCode;
        });
    });
</script>
@endsection
