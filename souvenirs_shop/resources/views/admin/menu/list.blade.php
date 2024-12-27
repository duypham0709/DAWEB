@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 75px">ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th>Tasks</th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::menu($menu) !!}
        </tbody>
    </table>
@endsection