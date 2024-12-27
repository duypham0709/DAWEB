@extends('main')

@section('content')
<div class="bg0 p-tb-160">
    <div class="container">
        @if (session('success'))
            <!-- Hiển thị thông báo thành công -->
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @else
            <!-- Hiển thị form đặt hàng nếu không có thông báo success -->
            <form method="POST">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">    
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
                                            <td class="column-4">{{ $quantity }}</td>
                                            <td class="column-5">{{ number_format($priceSub, 0, ',', ',') . 'đ' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @csrf
                        </div>
                    </div>
                    
                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Giao hàng
                            </h4>
                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">
                                    <h4 class="mtext-108 cl2 p-t-3 p-b-20">Phương thức thanh toán:</h4>

                                        @if ($errors->has('payment'))
                                            <span class="text-danger">
                                                {{ $errors->first('payment') }}</span>
                                        @endif
                                    <label class="container-radio">
                                        <input type="radio" name="payment" value="momo" id="momo">
                                            <span class="checkmark"></span>
                                                MoMo
                                    </label>
                                    <label class="container-radio">
                                        <input type="radio" name="payment" value="cod" id="cod">
                                            <span class="checkmark"></span>
                                                Tiền mặt
                                    </label>
                                    <div class="p-t-15">
                                        <h4 class="mtext-108 cl2 p-t-3 p-b-20">
                                            Thông tin khách hàng
                                        </h4>

                                            @if ($errors->has('name'))
                                            <span class="text-danger">
                                                {{ $errors->first('name') }}</span>
                                            @endif
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" 
                                                name="name" placeholder="Tên người nhận">
                                        </div>

                                            @if ($errors->has('phone'))
                                            <span class="text-danger">
                                                {{ $errors->first('phone') }}</span>
                                            @endif
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" 
                                                name="phone" placeholder="Số điện thoại">
                                        </div>

                                            @if ($errors->has('address'))
                                            <span class="text-danger">
                                                {{ $errors->first('address') }}</span>
                                            @endif
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                                name="address" placeholder="Địa chỉ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Thành tiền:
                                    </span>
                                </div>
                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        {{ number_format($total, 0, ',', ',') . 'đ' }}
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Đặt hàng
                            </button>
                        </div>
                    </div>      
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
