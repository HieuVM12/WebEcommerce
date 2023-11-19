<div>
    @foreach ($productsRelated as $key=>$productRelated)
    <div class="modal fade" id="productView-{{$key}}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content overflow-hidden border-0">
                <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-0">
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 p-lg-0"><a class="glightbox product-view d-block h-100 bg-cover bg-center"
                                style="background: url({{asset($productRelated->productImages[0]->image)}})"
                                href="{{asset($productRelated->productImages[0]->image)}}" data-gallery="gallery1"
                                data-glightbox="Red digital smartwatch"></a><a class="glightbox d-none"
                                href="img/product-5-alt-1.jpg" data-gallery="gallery1"
                                data-glightbox="Red digital smartwatch"></a><a class="glightbox d-none"
                                href="img/product-5-alt-2.jpg" data-gallery="gallery1"
                                data-glightbox="Red digital smartwatch"></a></div>
                        <div class="col-lg-6">
                            <div class="p-4 my-md-4">
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                    <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i>
                                    </li>
                                    <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i>
                                    </li>
                                    <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i>
                                    </li>
                                    <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i>
                                    </li>
                                </ul>
                                <h2 class="h4">{{$productRelated->name}}</h2>
                                <p class="text-muted">{{ number_format($productRelated->selling_price,0,",",".") }}₫</p>
                                <p class="text-sm mb-4">{{$productRelated->small_description}}</p>
                                <div class="row align-items-stretch mb-4 gx-0">
                                    <div class="col-sm-7">
                                        <div class="border d-flex align-items-center justify-content-between py-1 px-3">
                                            <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                            <div class="quantity">
                                                <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                                <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                                                <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5"><a
                                            class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0"
                                            href="cart.html">Add to cart</a></div>
                                </div><a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i
                                        class="far fa-heart me-2"></i>Add to wish list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <!-- PRODUCT SLIDER-->
                    <div class="row m-sm-0">
                        <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0 px-xl-2">
                            <div
                                class="swiper product-slider-thumbs swiper-initialized swiper-vertical swiper-pointer-events swiper-thumbs">
                                <div class="swiper-wrapper" id="swiper-wrapper-a9384c3b8ae191e4">
                                    @foreach ($product->productImages as $productImage)
                                    <div class="swiper-slide h-auto swiper-thumb-item mb-3 ">
                                        <img class="w-100" src="{{asset($productImage->image)}}" alt="...">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10 order-1 order-sm-2">
                            <div
                                class="swiper product-slider swiper-initialized swiper-horizontal swiper-pointer-events">
                                <div class="swiper-wrapper" id="swiper-wrapper-a9384c3b8ae191e4">
                                    @foreach ($product->productImages as $key=>$productImage)
                                    <div class="swiper-slide h-auto"><a class="glightbox product-view"
                                            href="{{asset($productImage->image)}}" data-gallery="gallery2"
                                            data-glightbox="Product item"><img class="img-fluid"
                                                src="{{asset($productImage->image)}}" alt="..."></a></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT DETAILS-->

                <div class="col-lg-6">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                    @endif
                    <ul class="list-inline mb-2 text-sm">
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
                    </ul>
                    <h1>{{$product->name}}</h1>
                    <p class="text-muted lead">{{ number_format($product->selling_price,0,",",".") }}₫</p>
                    <p class="text-sm mb-4">{{$product->summary}}</p>
                    <div class="row align-items-stretch mb-4">
                        @foreach ($product->productColors as $productColor)
                        <div class="col-sm-3">
                            <input type="radio" wire:click='colorSelected({{$productColor->id}})' name="colorSelection"
                                style="accent-color:{{$productColor->color->code}}; width:15px; height:15px">{{$productColor->color->name}}
                            {{-- <label class="colorSelectionLabel" wire:click='colorSelected({{$productColor->id}})'
                                style="background-color: {{$productColor->color->code}}">{{$productColor->color->name}}</label>
                            --}}
                        </div>
                        @endforeach
                    </div>
                    <div class="align-items-stretch mb-4">
                        <div class="col-sm-3">
                            @if ($this->productColorSelectedQuantity < 0) <label
                                class="btn-sm py-1 mt-2 text-white bg-danger">Hết hàng</label>
                                @elseif($this->productColorSelectedQuantity >= 0)
                                <label class="btn-sm py-1 mt-2 text-white bg-success">Còn hàng</label>
                                @endif
                        </div>
                    </div>
                    <div class="row align-items-stretch mb-4">
                        <div class="col-sm-5 pr-sm-0">
                            <div
                                class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                <span class="small text-uppercase text-gray mr-4 no-select">Số lượng</span>
                                <div class="quantity">
                                    <button class="p-0" wire:click="decrementQuantity"><i
                                            class="fas fa-caret-left"></i></button>
                                    <input class="form-control border-0 shadow-0 p-0" type="text"
                                        value="{{$this->quantityCount}}" wire:model="quantityCount">
                                    <button class="p-0" wire:click="incrementQuantity"><i
                                            class="fas fa-caret-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pl-sm-0"><a
                                class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0"
                                href="#" wire:click="addToCart({{$product->id}})">Thêm vào giỏ hàng</a></div>
                    </div><a class="text-dark p-0 mb-4 d-inline-block" href="#"
                        wire:click.prevent="addToWishlist({{$product->id}})"><i class="far fa-heart me-2"></i>Thêm
                        vào
                        mục yêu thích</a><br>
                    <ul class="list-unstyled small d-inline-block">
                        <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Danh
                                mục:</strong><a class="reset-anchor ms-2"
                                href="{{url('/'.$product->category->slug)}}">{{$product->category->name}}</a></li>
                    </ul>
                </div>
            </div>
            <!-- DETAILS TABS-->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab"
                        href="#description" role="tab" aria-controls="description" aria-selected="true">Mô tả sản
                        phầm</a>
                </li>
                <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab"
                        href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Nhận xét</a></li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <p class="text-muted text-sm mb-0">{{$product->description}}</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0"><img class="rounded-circle"
                                            src="/frontend/img/customer-1.png" alt="" width="50" /></div>
                                    <div class="ms-3 flex-shrink-1">
                                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                        <ul class="list-inline mb-1 text-xs">
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i
                                                    class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                        <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua.</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle"
                                            src="/frontend/img/customer-2.png" alt="" width="50" /></div>
                                    <div class="ms-3 flex-shrink-1">
                                        <h6 class="mb-0 text-uppercase">Jane Doe</h6>
                                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                        <ul class="list-inline mb-1 text-xs">
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i
                                                    class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                        <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- RELATED PRODUCTS-->
            <h2 class="h5 text-uppercase mb-4">Sản phẩm liên quan</h2>
            <div class="row">
                <!-- PRODUCT-->
                @foreach ($productsRelated as $key=>$productRelated)
                <div class="col-lg-3 col-sm-6">
                    <div class="product text-center skel-loader">
                        <div class="d-block mb-3 position-relative"><a class="d-block"
                                href="{{url('/product/'.$productRelated->slug)}}"><img class="img-fluid w-100"
                                    src="{{asset($productRelated->productImages[0]->image)}}" alt="..."></a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark"
                                            href="#!"><i class="far fa-heart"></i></a></li>
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#!">Thêm
                                            vào giỏ hàng</a></li>
                                    <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark"
                                            href="#productView-{{$key}}" data-bs-toggle="modal"><i
                                                class="fas fa-expand"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h6> <a class="reset-anchor"
                                href="{{url('/product/'.$productRelated->slug)}}">{{$productRelated->name}}</a></h6>
                        <p class="small text-muted">{{ number_format($productRelated->selling_price,0,",",".") }}₫ </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
