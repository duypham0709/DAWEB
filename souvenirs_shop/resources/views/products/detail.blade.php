@extends('main')

@section('content')
<div class="container p-t-80">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="/danh-muc/{{ $product->menu->id }}-{{ Str::slug($product->menu->name) }}.html" class="stext-109 cl8 hov-cl1 trans-04">
            {{ $product->menu->name }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $title }}
        </span>
    </div>
    <!-- Hiển thị thông báo session -->
    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
</div>

<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"><ul class="slick3-dots" role="tablist" style="">
                            <li class="slick-active" role="presentation">
                                
                            </li>
                            </ul>
                        </div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; width: 753px;">
                                    <div class="item-slick3 slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10" style="width: 251px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ $product->thumb }}" style="width: 500px" alt="IMG-PRODUCT">
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $title }}
                    </h4>

                    <span class="mtext-106 cl2">
                        {!! \App\Helpers\Helper::price($product->price) !!}
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        {{ $product->description }}
                    </p>
                    
                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-m p-b-15">
                    
                            <!-- Kiểm tra số lượng sản phẩm -->
                            @if ($product->Soluong > 0)
                            <form action="/add-cart" method="post">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <!-- Nút giảm số lượng -->
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>
                    
                                    <!-- Ô nhập số lượng -->
                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product" value="1" min="1" max="{{ $product->soluong }}">
                    
                                    <!-- Nút tăng số lượng -->
                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                                
                                <!-- Nút Thêm vào giỏ hàng -->
                                <button type="submit" name="action" value="add_cart"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Thêm giỏ hàng
                                </button>
                    
                                <!-- Nút Mua ngay -->
                                <button type="submit" name="action" value="buy_now"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 flex-w m-r-20 m-tb-15">
                                        Mua ngay
                                </button>
                    
                                <!-- Truyền thông tin sản phẩm -->
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @csrf
                            </form>
                            @else
                            <p class="text-danger mtext-104 cl3">Sản phẩm này hiện đã hết hàng.</p>
                            @endif
                    
                        </div>	
                    </div>
                    

                    <!--  -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {!! $product->content !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            Categories: {!! $product->menu->name !!}
        </span>
    </div>
</section>
@endsection