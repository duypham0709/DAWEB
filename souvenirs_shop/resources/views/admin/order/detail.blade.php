@extends('admin.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Thông tin khách hàng</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: start">Họ tên:</th>
                        <td style="text-align: left">{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: start">Số điện thoại:</th>
                        <td style="text-align: left">{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: start">Địa chỉ:</th>
                        <td style="text-align: left">{{ $order->address }}</td>
                    </tr>
            </table>
        </div>
    </div>
    <br>
    <h3>Thông tin sản phẩm</h3>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                {{-- <th style="width: 30px;"></th> --}}
            </tr>
        </thead>
        <tbody class="table">
            <style>
                .table {
                    width: 100%;
                    /* Đảm bảo bảng chiếm toàn bộ chiều ngang */
                    border-collapse: collapse;
                }

                .table td,
                th {
                    text-align: center;
                    /* Căn giữa nội dung theo chiều ngang */
                    vertical-align: middle;
                    /* Căn giữa nội dung theo chiều dọc */
                    padding: 10px;
                    /* Thêm khoảng cách để thông tin không bị chật */
                    width: 30px;
                    "

                }

                /* Căn giữa hình ảnh */
                .table img {
                    display: block;
                    margin: 0 auto;
                    /* Căn giữa hình ảnh theo chiều ngang */
                }
            </style>
            @foreach ($order->details as $item)
                <tr>
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
    <div class="card-footer clearfix">

    </div>
@endsection
