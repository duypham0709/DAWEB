@extends('admin.main')

@section('head')
    <script src="/ckditor5/ckeditor5.js"></script>
@endsection

@section('content')
    <!--div class="card card-primary"-->
    <!-- /.card-header -->
    <!-- form start -->
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục">
            </div>


            <div class="form-group">
                <label>Danh mục</label>
                <select class="form-control" name="parent_id" id="">
                    <option value="0">Danh mục cha</option>
                    {{-- @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach --}}
                </select>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
        @csrf
    </form>

    <!--/div-->
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
