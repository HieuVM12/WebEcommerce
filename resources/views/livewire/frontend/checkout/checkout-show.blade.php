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
                                <li class="breadcrumb-item"><a class="text-dark" href="{{url('/index')}}">Trang chủ</a>
                                </li>
                                <li class="breadcrumb-item"><a class="text-dark" href="{{url('/cart')}}">Giỏ hàng</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container p-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h5>Sản phẩm đặt hàng</h5>
                            <hr>
                            <div class="table-responsive mb-4">
                                <table class="table text-nowrap">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0 p-3" scope="col"> <strong
                                                    class="text-sm text-uppercase">Sản
                                                    phẩm</strong></th>
                                            <th class="border-0 p-3" scope="col"> <strong
                                                    class="text-sm text-uppercase">Đơn giá
                                                </strong></th>
                                            <th class="border-0 p-3" scope="col"> <strong
                                                    class="text-sm text-uppercase">Màu
                                                </strong></th>
                                            <th class="border-0 p-3" scope="col"> <strong
                                                    class="text-sm text-uppercase">Số
                                                    lượng</strong></th>
                                            <th class="border-0 p-3" scope="col"> <strong
                                                    class="text-sm text-uppercase">Tổng</strong></th>

                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @foreach ($carts as $cartItem)
                                        <tr>
                                            <th class="ps-0 py-3 border-light" scope="row">
                                                <div class="d-flex align-items-center"><a
                                                        class="reset-anchor d-block animsition-link"
                                                        href="{{url('/product/'.$cartItem->product->slug)}}"><img
                                                            src="{{asset($cartItem->product->productImages[0]->image)}}"
                                                            alt="..." width="70" /></a>
                                                    <div class="ms-3"><strong class="h6"><a
                                                                class="reset-anchor animsition-link"
                                                                href="{{url('/product/'.$cartItem->product->slug)}}">{{$cartItem->product->name}}</a></strong>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="p-3 align-middle border-light">
                                                <p class="mb-0 small">{{
                                                    number_format($cartItem->product->selling_price,0,",",".") }}₫</p>
                                            </td>
                                            <td class="p-3 align-middle border-light">
                                                <p class="mb-0 small">{{$cartItem->productColor->color->name}}</p>
                                            </td>
                                            <td class="p-3 align-middle border-light">
                                                <p class="mb-0 small">{{$cartItem->quantity}}</p>
                                            </td>
                                            <td class="p-3 align-middle border-light">
                                                <p class="mb-0 small">{{number_format($cartItem->product->selling_price
                                                    *
                                                    $cartItem->quantity,0,",",".")}}₫</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4"><strong>Tổng tiền</strong></td>
                                            <td colspan="1">{{number_format($totalProductAmout,0,",",".")}}₫</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- BILLING ADDRESS-->
            <h2 class="h5 text-uppercase mb-4">Thông tin cá nhân</h2>
            <div class="row">
                <div class="col-lg-8">
                    <form action="#">
                        <div class="row gy-3">
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="firstName">Họ tên </label>
                                <input class="form-control form-control-lg" type="text" id="fullname" name="fullname"
                                    wire:model='fullname' required>
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
                                <label class="form-label text-sm text-uppercase" for="address">Địa chỉ giao hàng 1
                                </label>
                                <input class="form-control form-control-lg" type="text" id="address"
                                    wire:model='address'>
                                @error('address')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="addressalt">Địa chỉ giao hàng 2
                                </label>
                                <input class="form-control form-control-lg" type="text" id="address2"
                                    wire:model='address2'>
                                @error('address2')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
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
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small fw-bold">Tổng
                                        tiền</strong><span>{{number_format($totalProductAmout,0,",",".")}}₫</span></li>
                                @if (session('discount_value'))
                                <li class="d-flex align-items-center justify-content-between"><strong
                                    class="text-uppercase small fw-bold text-danger">Giảm giá (-{{session('discount_value')}}%)</strong><span class="text-danger">-{{number_format($totalProductAmout*session('discount_value')/100,0,",",".")}}₫</span></li>
                                @endif
                                <hr>
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small fw-bold">Thanh
                                        toán</strong><span>{{number_format($totalProductAmout - $totalProductAmout*session('discount_value')/100,0,",",".")}}₫</span></li>
                                <br>
                                <li>
                                    <div class="input-group mb-0">
                                        <input wire:model="discountCode" class="form-control" type="text"
                                            placeholder="Nhập mã giảm giá">
                                        <a class="btn btn-dark btn-sm w-100" wire:click.prevent="applyDiscountCode"> <i
                                                class="fas fa-gift me-2"></i>Mã giảm giá</a>
                                    </div>
                                </li>
                            </ul>
                            <br>
                            <button class="btn btn-success" wire:click='codeOrder'
                                style="border-radius:4px; height: 45px; width:334.4px; margin-bottom: 12px ">Thanh toán
                                khi nhận hàng</button>
                            <div class="row" wire:ignore>
                                <div>
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script
    src="https://www.paypal.com/sdk/js?client-id=AVsr7p7IJEkAyR8kOyEpiExqJ1AQuw5lgV_dmuBZx0LrMlRyz5EmthjHtVt8ATIwy59PvDs0eqZzfel1&currency=USD">
</script>
<script>
    paypal.Buttons({
        onClick: function() {
            if(!document.getElementById('fullname').value || !document.getElementById('email').value || !document.getElementById('phone').value || !document.getElementById('address').value){
                Livewire.emit('validationForAll');
                return false;
            }else{
                @this.set('fullname',document.getElementById('fullname').value);
                @this.set('email',document.getElementById('email').value);
                @this.set('phone',document.getElementById('phone').value);
                @this.set('address',document.getElementById('address').value);
                @this.set('address2',document.getElementById('address2').value);
            }
        },
        createOrder: (data, actions) =>{
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "{{ number_format(($this->totalProductAmount*(100-session('discount_value'))/100) / 23000, 2, '.', '') }}"
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData){
                console.log('Capture result', orderData, JSON.stringify(orderData,null,2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                if(transaction.status == "COMPLETED"){
                    Livewire.emit('transactionEmit', transaction.id);
                }
            });
        }
    }).render('#paypal-button-container');
</script>
@endpush
