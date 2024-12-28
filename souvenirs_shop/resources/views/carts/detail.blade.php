@extends('main')

@section('content')
    <div class="bg0 p-tb-200">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-9 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <h3>Thông tin sản phẩm</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th></th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $item)
                                    <tr class="table_row h-50">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ $item->products->thumb }}" width="60"></td>
                                        <td>{{ $item->products->name }}</td>
                                        <td>{{ $item->soluong }}</td>
                                        <td>{{ number_format($item->price, 0, ',', ',') . 'đ' }}</td>
                                        <td>{{ number_format($item->price * $item->soluong, 0, ',', ',') . 'đ' }}</td>
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
