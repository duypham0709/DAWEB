@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Hình ảnh</th>
                <th>Danh Mục</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Active</th>
                <th>Update</th>
                <th>&nbsp;</th>
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
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img src={{ $product->thumb }} height="100" width="100"></td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', ',') }} đ</td>
                    <td>{{ $product->Soluong }}</td>
                    <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                    <td>{{ $product->updated_at->format('d/m/Y') }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                            onclick ="removeRow({{ $product->id }}, '/admin/products/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $products->links() !!}
    </div>
@endsection
