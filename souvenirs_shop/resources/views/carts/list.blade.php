@extends('main')

@section('content')
<div class="bg0 p-tb-130">   
    <div class="container">
        @if(!empty($products) && count($products) > 0)
        <form method="POST">
            <div class="row">        
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
        
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif    
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">                          
                                @php $total = 0; @endphp
                                <tbody>
                                <tr class="table_head">
                                    <th class="column-1">Sản phẩm</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Giá</th>
                                    <th class="column-4">Số lượng</th>
                                    <th class="column-5">Tổng</th>
                                </tr>

                                @foreach($products as $product)
                                    @php
                                        $price = $product->price;
                                        $quantity = $cart->products()->where('product_id', $product->id)->first()->pivot->soluong;
                                        $priceSub = $price * $quantity;
                                        $total += $priceSub;
                                    @endphp
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $product->thumb }}" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $product->name }}</td>
                                        <td class="column-3">{{ number_format($price, 0, ',', ',') . 'đ' }}</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number" 
                                                    name="num_product[{{ $product->id }}]" value="{{ $quantity }}">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5">{{ number_format($priceSub, 0, ',', ',') . 'đ' }}</td>
                                        <td class="column-6 p-r-15">
                                            <a href="/carts/delete/{{ $product->id }}">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @csrf
                        </div>
                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-r-10 m-l-300 m-tb-10"
                                type="submit" value="Cập nhật" formaction="/update-cart">
                                </input>
                        
                            <a href="{{ route('order.checkout') }}" type="submit"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 m-l-64">
                                    Đặt hàng
                                </a>
                            </div>
                        
                        </div>           

                    </div>
                </div>
            </div>
        </form>
        @else
            <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                <h2>Giỏ hàng trống</h2>
            </div>
        @endif  
    </div>
</div>
@endsection
