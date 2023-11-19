<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Giỏ hàng</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <h2 class="h5 text-uppercase mb-4">Giỏ hàng</h2>
            <div class="row">
                <div class="col-lg-12 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Sản
                                            phẩm</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Đơn giá
                                        </strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Màu
                                        </strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Số
                                            lượng</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Tổng</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase"></strong>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
                                @foreach ($cart as $cartItem)
                                <tr>
                                    <th class="ps-0 py-3 border-light" scope="row">
                                        <div class="d-flex align-items-center"><a
                                                class="reset-anchor d-block animsition-link"
                                                href="{{url('/product/'.$cartItem->product->slug)}}"><img
                                                    src="{{asset($cartItem->product->productImages[0]->image)}}"
                                                    alt="..." width="70" /></a>
                                            <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link"
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
                                        <div class="border d-flex align-items-center justify-content-between px-3"><span
                                                class="small text-uppercase text-gray headings-font-family">Số
                                                lượng</span>
                                            <div class="quantity">
                                                <button class="p-0" wire:loading.attr='disabled'
                                                    wire:click='decrementQuantity({{$cartItem->id}})'><i
                                                        class="fas fa-caret-left"></i></button>
                                                <input class="form-control form-control-sm border-0 shadow-0 p-0"
                                                    type="text" value="{{$cartItem->quantity}}" />
                                                <button class="p-0" wire:loading.attr='disabled'
                                                    wire:click='incrementQuantity({{$cartItem->id}})'><i
                                                        class="fas fa-caret-right"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3 align-middle border-light">
                                        <p class="mb-0 small">{{number_format($cartItem->product->selling_price *
                                            $cartItem->quantity,0,",",".")}}₫</p>
                                    </td>
                                    <td class="p-3 align-middle border-light"><a class="reset-anchor" href="#"
                                            wire:click.prevent='removeCartItem({{$cartItem->id}})'
                                            wire:loading.attr='disabled'><i
                                                class="fas fa-trash-alt small text-muted"></i></a></td>
                                </tr>
                                @php
                                $totalPrice += $cartItem->product->selling_price * $cartItem->quantity
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- CART NAV-->
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0"></div>
                <div class="col-lg-4 mb-4 mb-lg-0"></div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Tổng thanh toán</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between mb-4"><strong
                                        class="text-uppercase small font-weight-bold">Tổng
                                        tiền</strong><span>{{number_format($totalPrice,0,",",".")}}₫
                                    </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a
                                    class="btn btn-link p-0 text-dark btn-sm" href="{{url('/index')}}"><i
                                        class="fas fa-long-arrow-alt-left me-2"> </i>Tiếp tục mua sắm</a>
                            </div>
                            <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm"
                                    href="{{url('/checkout')}}">Xác nhận địa chỉ<i
                                        class="fas fa-long-arrow-alt-right ms-2"></i></a></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
