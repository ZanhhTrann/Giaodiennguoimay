
<link rel="stylesheet" href="{{asset('css/layouts_css/login_register.css')}}">
@extends('auth.layouts.sign_layout')
@section('content')
<div class="container">
    <h1>Đăng nhập</h1>
    <form action="{{route('checksignup')}}" method="POST">
        @csrf
        <div class="form-control">
            <input name="email" value="{{ old('email') }}" type="text" required>
            <label>Email</label>
        </div>
        <div class="form-control">
            <input name="password" type="password" required>
            <label>Mật khẩu</label>
        </div>
        <button class="btn">Đăng nhập</button>
        <div class="orther">
            <button class="btn_orther"><i class="fa-brands fa-facebook-f"></i>Facebook</button>
            <button class="btn_orther"><i class="fa-brands fa-google"></i>Google</button>
        </div>
        <p class="text">Lần đầu bạn đến với NA BRIDAL?
            <a href="{{route('pages.index',['page'=>'signin'])}}"> Đăng kí!</a>
        </p>
    </form>
</div>
<script src="{{asset('js/form_wave_input.js')}}"></script>
@endsection

