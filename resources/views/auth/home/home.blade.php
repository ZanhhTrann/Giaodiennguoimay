@extends('auth.layouts.app')
@section('header')
@include('auth.layouts.includes.header',['head_page'=>'home'])
@endsection
@section('content')
<section id="section" class="section_home">
    @include('auth.home.includes.slider')
    <div class="outstanding">
        <h1>VÁY CƯỚI NỔI BẬT</h1>
        @include('auth.home.includes.banner')
    </div>
    {{-- Nguoi noi tieng da su dung va danh gia dich vu --}}
    <div class="celebrity">
        <h2>Những người nổi tiếng</h2>
        <h2>Đã chọn váy cưới nhà NA BRIDAL</h2>
        <div class="celebrity_review">
            <div class="left review_content">
                <div class="banner_review">
                    <div class="banner-img">
                        <img src="{{asset('imgs/xoainon.jpg')}}" alt="">
                    </div>
                </div>
                <div class="content">
                    <div class="text">
                        <h3>____Cô dâu Xoài Non____</h3>
                        <p>Mẫu áo dài trắng mà người đẹp chọn diện trong ngày cưới là thiết kế được kết hợp giữa hoạ tiết hoàng gia và phong cách rococo.
                            Phong cách này là khái niệm dùng để mô tả các công trình trang trí lộng lẫy, cầu kỳ. Sử dụng nhiều đường cong, hình xoắn ốc.
                             Một điểm nhấn trong thiết kế áo dài là phần khoét cổ sâu kết hợp vải xuyên thấu.
                        </p>
                    </div>
                </div>

            </div>
            <div class="right review_content">
                <div class="content">
                    <div class="text">
                        <h3>____Cô dâu Minh Trang____</h3>
                        <p>
                            Váy cưới hở vai là lựa chọn của cô dâu Minh Trang - mẫu thiết kế vừa quyến rũ vừa ngọt ngào.
                             Với váy cưới hở vai của NA Bridal, bạn không chỉ là người phụ nữ quyến rũ và đẹp đẽ, mà còn là người phát triển phong cách cá nhân của mình một cách tinh tế và sành điệu trong ngày trọng đại nhất của cuộc đời. Điểm nhấn táo bạo từ phần vai mở ra tạo nên sự thu hút không giới hạn, trong khi vẫn giữ được sự lịch lãm và sang trọng.
                             Chất liệu vải cao cấp như ren, lụa, hoặc chiffon được sử dụng để tạo nên chiếc váy cưới hở vai, mang lại cảm giác mềm mại và êm dịu.
                        </p>
                    </div>
                </div>
                <div class="banner_review">
                    <div class="banner-img">
                        <img src="{{asset('imgs/banner-02.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="load_more">
        <div class="container">
            <a class="btn" href="{{ route('pages.index', ['page' => 'shop']) }}">Xem thêm</a>
        </div>
    </div>
    <div class="lend">
        <span></span>
    </div>
    <div class="slogen">
        <h2>NA BRIDAL - NÉT ĐẸP KIÊU SA TẠO NÊN HẠNH PHÚC VĨNH CỬU</h2>
    </div>
    {{-- @include('auth.includes.load_more') --}}
</section>
<script src="{{ asset('js/home.js') }}"></script>
@endsection


