@extends('main')

@section('content')
<div class="bg0 p-tb-200">   
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">   
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <h3>Đơn hàng</h3>   
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">                          
                            <tbody><tr class="table_head">
                                <th class="column-1" style="padding-left: 0px">STT</th>
                                <th class="column-2">Ngày đặt hàng</th>
                                <th class="column-3">Địa chỉ</th>
                                <th class="column-4">Tổng tiền</th>
                                <th class="column-5">Tình trạng</th>
                                <th class="column-6"></th>
                            </tr>
                            @foreach($customer->orders as $item)
                                <tr class="table_row h-50">
                                    <td class="column-1" style="padding-left: 0px">{{ $loop->index + 1 }}</td>
                                    <td class="column-2">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td class="column-3">{{ $item->address }}</td>
                                    <td class="column-4">{{ number_format($item->totalPrice, 0, ',', ',') . 'đ' }}</td>
                                    <td class="column-5">@if ($item->status == 0)
                                                        <span>Đã xác nhận</span>
                                                        @else
                                                        <span>Đã thanh toán</span>
                                                        @endif
                                                    </td>
                                                    <td td class="column-6">
                                                        <a href="{{ route('order.detail', $item->id) }}" class="btn btn-primary">Detail</a>
                                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>          
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection