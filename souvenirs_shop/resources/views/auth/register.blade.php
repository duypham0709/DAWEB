@extends('layouts.default')
@section('title', 'Register')
@section('content')
    <section class="py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                        <h2 class="display-5 fw-bold text-center">Đăng ký tài khoản</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="row gy-5 justify-content-center">
                        <div class="col-12 col-lg-5">
                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <div class="row gy-3 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control border-0 border-bottom rounded-0"
                                                name="fullname" id="name" value="{{ old('fullname') }}"
                                                placeholder="Điền họ tên" required>
                                            <label for="name" class="form-label">Họ và tên</label>
                                            @if ($errors->has('fullname'))
                                                <span class="text-danger">
                                                    {{ $errors->first('fullname') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control border-0 border-bottom rounded-0"
                                                name="email" id="email" value="{{ old('email') }}"
                                                placeholder="name@example.com" required>
                                            <label for="email" class="form-label">Email</label>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">
                                                    {{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control border-0 border-bottom rounded-0"
                                                name="password" id="password" value="" placeholder="Password"
                                                required>
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">
                                                    {{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control border-0 border-bottom rounded-0"
                                                name="password_confirmation" id="password_confirmation" value=""
                                                placeholder="Confirm password" required>
                                            <label for="password_confirmation" class="form-label">Xác thực lại mật
                                                khẩu</label>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger">
                                                    {{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control border-0 border-bottom rounded-0"
                                                name="phone" id="phone" value="{{ old('phone') }}"
                                                placeholder="Nhập số điện thoại" required>
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">
                                                    {{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">

                                            <p class="text-center m-0">Đã có tài khoản? <a href="/customer/login">
                                                    Đăng nhập</a></p>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-lg btn-dark rounded-0 fs-6" type="submit">Sign
                                                in</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
