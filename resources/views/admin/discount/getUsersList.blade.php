@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card-header">
                <h3>Gửi Code đến khách hàng
                    <a href="{{url('admin/discounts')}}" class="btn btn-sm btn-primary float-end">Quay lại</a>
                </h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5>Mã giảm giá</h5>
                        <hr>
                        <p>Code: <strong>{{$discount->code}}</strong></p>
                        <p>Phần trằm giảm giá: {{$discount->discount_percentage}}%</p>
                        <p>Ngày bắt đầu: {{ \Carbon\Carbon::parse($discount->valid_from)->format('d-m-Y') }}</p>
                        <p>Ngày kết thúc: {{ \Carbon\Carbon::parse($discount->valid_to)->format('d-m-Y') }}</p>
                        <p>Mô tả: {{$discount->description}}</p>
                    </div>
                </div>
                <hr>
                <form action="{{url('/admin/sendCode/'.$discount->id)}}" method="POST" id="form1">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-outline-success float-end" type="submit"
                                onclick="return confirm('Chắc chắn gửi code đến những người dùng này?')">Gửi
                                Code</button>
                            <a href="{{url('admin/sendCodeAllUsers/'.$discount->id)}}" class="btn btn-outline-success float-end" type="submit">Gửi Code cho tất cả
                                khách hàng</a>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Tên
                                            khách hàng</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Email
                                        </strong></th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
                                @foreach ($users as $user)
                                <tr>
                                    <td class="p-3 align-middle border-light"><input type="checkbox"
                                            name="ids[{{$user->id}}]" value="{{$user->id}}"
                                            data-user-id="{{$user->id}}"></td>
                                    <td class="p-3 align-middle border-light">
                                        <p class="mb-0">{{$user->name}}</p>
                                    </td>
                                    <td class="p-3 align-middle border-light">
                                        <p class="mb-0">{{$user->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{$users->links()}}
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    console.log(3);
    const checkAll = document.getElementById("checkAll");
    const items = document.getElementById('form1').querySelectorAll("input[type='checkbox'][name^='ids']");

    checkAll.addEventListener("change", function () {
        items.forEach(item => {
            item.checked = checkAll.checked;
        });
    });
</script>
@endsection
