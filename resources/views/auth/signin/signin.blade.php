
<link rel="stylesheet" href="{{asset('css/layouts_css/login_register.css')}}">
@extends('auth.layouts.sign_layout')
@section('content')
<div class="container">
    <h1>Đăng ký</h1>
    <form action="{{route('checksignin')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-control">
            <input type="text" value="{{ old('name') }}" name="name" required>
            <label>Họ và tên</label>
        </div>
        <div class="form-control">
            <input type="text" value="{{ old('email') }}" name="email" required>
            <label>Email</label>
        </div>
        <div class="form-control">
            <input id="password" type="password"
            name="password" required>
            <label>Mật khẩu</label>
        </div>
        <div class="form-control">
            <input id="confirm_password" type="password"
            name="password_confirm" required>
            <label>Xác nhận lại mật khẩu</label>
        </div>
        <button class="btn">Đăng ký</button>
        <div class="orther">
            <button class="btn_orther"><i class="fa-brands fa-facebook-f"></i>Facebook</button>
            <button class="btn_orther"><i class="fa-brands fa-google"></i>Google</button>
        </div>
        <p class="text">Bạn đã tới với NA BRIDAL trước đó?
            <a href="{{route('pages.index',['page'=>'signup'])}}"> Đăng nhập</a>
        </p>
    </form>
</div>
<script src="{{asset('js/form_wave_input.js')}}"></script>
@endsection

