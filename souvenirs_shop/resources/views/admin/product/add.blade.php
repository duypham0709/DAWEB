@extends('admin.main')

@section('head')
    <script src="/ckeditor5/ckeditor5.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên Sản Phẩm</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh Mục</label>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá</label>
                        <input type="number" name="price" value="{{ old('price') }}" class="form-control tien" >
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="menu">Số lượng</label>
                        <input type="number" name="Soluong" value="{{ old('Soluong') }}" class="form-control" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mô Tả sản phẩm</label>
                <textarea name="description" class="form-control"> {{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Nội dung sản phẩm</label>
                <textarea style="resize: none" rows="8" name="content" id="content"
                    class="form-control"> {{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh Sản Phẩm</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="img_show"></div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

            <div class="form-group">
                <label>Hiển thị</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Hiển thị</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Ẩn</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
        function doitien(var x)
        {
            let text = x.toLocaleString("vi", {style:"currency", currency:"VND"});

            return text;
        }
        document.addEventListener("DOMContentLoaded", function() {
            doitien(document.getElementByClass('tien').value)
        });
    </script>
@endsection
