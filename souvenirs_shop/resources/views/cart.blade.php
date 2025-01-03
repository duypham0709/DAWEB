{{-- <div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-25 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                <h2>Giỏ hàng</h2>
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        
        <div class="header-cart-content flex-w js-pscroll">

            @php 
                $sumPriceCart = 0;    
                $products = $products ?? []; // Nếu không có sản phẩm, mặc định là mảng rỗng
            @endphp

            <ul class="header-cart-wrapitem w-full">

                @if (!empty($products) && count($products) > 0)
                    @foreach($products as $product)
                    @php     
                        $soluong = $product->pivot->soluong ?? 0;  
                        $price = $product->price ?? 0;
                        $totalProductPrice = $soluong * $price;
                        $sumPriceCart += $totalProductPrice;
                    @endphp
                
                    <li class="header-cart-item flex-w flex-t m-b-20">
                        <div class="header-cart-item-img">
                            <img src="{{ $product->thumb }}" alt="IMG">
                        </div>
                        
                        <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name m-b-2 hov-cl1 trans-04">
                                {{ $product->name }}
                            </a>
                
                            <span class="header-cart-item-info">
                                x{{ $soluong }}
                            </span>
                
                            <span class="header-cart-item-info">
                                {{ number_format($totalProductPrice, 0, ',', ',') . 'đ'}}
                            </span>
                        </div>
                    </li>
                    @endforeach
                    @else
                        <li class="header-cart-item m-b-20 text-center">
                            <span class="text-gray-500">Giỏ hàng của bạn đang trống.</span>
                        </li>
                        
                @endif

            </ul>
            
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Tổng tiền: {{ number_format($sumPriceCart, 0, ',', ',') . 'đ' }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="/carts" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Xác nhận đơn hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}