<div>
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Danh sách yêu thích</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách yêu thích</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <h2 class="h5 text-uppercase mb-4">Danh sách yêu thích</h2>
            <div class="row">
                <div class="col-lg-12 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Sản
                                            phẩm</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Giá
                                        </strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase"></strong>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
                                @foreach ($wishlist as $wishlistItem)
                                <tr>
                                    <th class="ps-0 py-3 border-light" scope="row">
                                        <div class="d-flex align-items-center"><a
                                                class="reset-anchor d-block animsition-link" href="{{url('/product/'.$wishlistItem->product->slug)}}"><img
                                                    src="{{asset($wishlistItem->product->productImages[0]->image)}}" alt="..." width="70" /></a>
                                            <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link"
                                                        href="{{url('/product/'.$wishlistItem->product->slug)}}">{{$wishlistItem->product->name}}</a></strong></div>
                                        </div>
                                    </th>
                                    <td class="p-3 align-middle border-light">
                                        <p class="mb-0 small">{{ number_format($wishlistItem->product->selling_price,0,",",".") }}₫</p>
                                    </td>
                                    <td class="p-3 align-middle border-light"><a class="reset-anchor" href="#" wire:click.prevent='removeWishlistItem({{$wishlistItem->id}})'><i
                                                class="fas fa-trash-alt small text-muted"></i></a></td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a
                                    class="btn btn-link p-0 text-dark btn-sm" href="{{url('/index')}}"><i
                                        class="fas fa-long-arrow-alt-left me-2"> </i>Trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ORDER TOTAL-->
            </div>
        </section>
    </div>
</div>
