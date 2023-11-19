<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Thanh toán</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="{{url('/index')}}">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a class="text-dark" href="{{url('/cart')}}">Giỏ hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <!-- BILLING ADDRESS-->
            <h2 class="h5 text-uppercase mb-4">Thông tin cá nhân</h2>
            <div class="row">
                <div class="col-lg-8">
                    <form action="#">
                        <div class="row gy-3">
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="firstName">Họ tên </label>
                                <input class="form-control form-control-lg" type="text" id="fullname" name="fullname" wire:model='fullname' required>
                                @error('fullname')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="email">Email</label>
                                <input class="form-control form-control-lg" type="email" id="email" wire:model='email'>
                                @error('email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="phone">Số điện thoại</label>
                                <input class="form-control form-control-lg" type="tel" id="phone" wire:model='phone'
                                    placeholder="">
                                @error('email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="address">Địa chỉ giao hàng 1 </label>
                                <input class="form-control form-control-lg" type="text" id="address" wire:model='address'>
                                @error('address')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="addressalt">Địa chỉ giao hàng 2 </label>
                                <input class="form-control form-control-lg" type="text" id="addressalt" wire:model='address2'>
                                @error('address2')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="city">Hình thức thanh toán </label>
                                <select name="payment_mode" id="" wire:model='payment_mode'>
                                    <option value="1" selected>Thanh toán khi nhận hàng</option>
                                    <option value="2">Thanh toán bằng Momo</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ORDER SUMMARY-->
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Hóa đơn của bạn</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach ($carts as $cartItem)
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="small fw-bold">{{$cartItem->product->name}} ({{$cartItem->productColor->color->name}})</strong><span
                                        class="text-muted small">x{{$cartItem->quantity}}</span></li>
                                <li class="border-bottom my-2"></li>
                                @endforeach
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small fw-bold">Tổng thanh toán</strong><span>{{number_format($totalProductAmout,0,",",".")}}₫</span></li>
                            </ul>
                            <br>
                            @if($payment_mode == 1)
                                <button class="btn btn-success" wire:click='codeOrder'>Thanh toán khi nhận hàng</button>
                                <button class="btn btn-success" style="display:none">Thanh toán bằng Momo</button>
                            @elseif($payment_mode == 2)
                                <button class="btn btn-success" style="display:none">Thanh toán khi nhận hàng</button>
                                <button class="btn btn-success">Thanh toán bằng Momo</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
