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
                                <input class="form-control form-control-lg" type="text" id="address2" wire:model='address2'>
                                @error('address2')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ORDER SUMMARY-->
                <div class="col-lg-4" wire:ignore>
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
                            <button class="btn btn-success" wire:click='codeOrder' style="border-radius:4px; height: 45px; width:334.4px; margin-bottom: 12px ">Thanh toán khi nhận hàng</button>
                            <div class="row">
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
<script src="https://www.paypal.com/sdk/js?client-id=AVsr7p7IJEkAyR8kOyEpiExqJ1AQuw5lgV_dmuBZx0LrMlRyz5EmthjHtVt8ATIwy59PvDs0eqZzfel1&currency=USD"></script>
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
                        value: "{{ number_format(($this->totalProductAmount) / 23000, 2, '.', '') }}"
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
