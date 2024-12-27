@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ngày đặt hàng</th>
                <th>Địa chỉ</th>
                <th>Tổng tiền</th>
                <th>Tình trạng</th>
                <th></th>
                {{-- <th style="width: 30px;"></th> --}}
            </tr>
        </thead>
        <tbody class="table">
            <style>
                .table {
                    width: 100%; /* Đảm bảo bảng chiếm toàn bộ chiều ngang */
                    border-collapse: collapse;
                }

                .table td, th {
                    text-align: center; /* Căn giữa nội dung theo chiều ngang */
                    vertical-align: middle; /* Căn giữa nội dung theo chiều dọc */
                    padding: 10px; /* Thêm khoảng cách để thông tin không bị chật */
                    width: 30px;"
                }

                /* Căn giữa hình ảnh */
                .table img {
                    display: block;
                    margin: 0 auto; /* Căn giữa hình ảnh theo chiều ngang */
                }
            </style>
            @foreach($orders as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ number_format($item->totalPrice, 0, ',', ',') . 'đ' }}</td>
                <td>@if ($item->status == 0)
                        <span>Đã xác nhận</span>
                    @else
                        <span>Đã thanh toán</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('order.show', $item->id) }}" class="btn btn-primary">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $orders->links() !!}
    </div>

@endsection