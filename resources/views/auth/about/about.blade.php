@php
    $pageCont=new \App\Http\Controllers\PagesController();
    $urlValues=$pageCont->__getURL($_SERVER['REQUEST_URI']);
    // echo $previousURL;
    // dd($urlValues)
@endphp
<link rel="stylesheet" href="{{asset('css/pages/about.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_about.css')}}">
@extends('auth.layouts.app')
@section('header')
@include('auth.layouts.includes.header',['head_page'=>$urlValues['head']])
@endsection
@section('content')
<section id="section" class="section_about">
    <div class="img_content">Giới thiệu</div>
    <div class="about_review">
        <div class="right review_content">
            <div class="content">
                <div class="about_text">
                    <h3>Về chúng tôi</h3>
                    <p>Bằng sự tận tâm và kiên nhẫn, chúng tôi luôn lắng nghe và hiểu rõ mong muốn của từng khách hàng.
                        Mỗi cuộc gặp gỡ tại NA Bridal không chỉ là việc chọn lựa váy cưới, mà còn là việc chia sẻ những câu chuyện về tình yêu và ước mơ.
                    </p>
                    <p>Những chiếc váy cưới từ NA Bridal không chỉ đẹp về mặt ngoại hình, mà còn đong đầy tình cảm và ý nghĩa.
                         Mỗi chiếc váy mang đến cho cô dâu không chỉ sự tự tin trong ngày trọng đại, mà còn là niềm hạnh phúc và kỷ niệm mãi mãi.
                    </p>
                    <p>
                        Có lẽ, NA Bridal không chỉ là nơi bán váy cưới, mà là nơi gắn kết những trái tim và tạo nên những câu chuyện tình yêu đẹp nhất.
                    </p>
                    <p>Thông tin liên hệ: <br>
                        <i class="fas fa-map-marker-alt"></i> Trường Đại học Phenikaa - Khoa Công nghệ thông tin <br>
                        <i class="fas fa-envelope"></i> NABridal@gmail.com
                    </p>

                </div>
            </div>
            <div class="banner_review">
                <div class="banner-img">
                    <img src="{{asset('imgs/about1.jpg')}}" alt="">
                </div>
            </div>
        </div>
        <div class="left review_content">
            <div class="banner_review">
                <div class="banner-img">
                    <img src="{{asset('imgs/about2.jpg')}}" alt="">
                </div>
            </div>
            <div class="content">
                <div class="about_text">
                    <h3>Sứ mệnh của NA Bridal</h3>
                    <p>NA Bridal không chỉ là cung cấp những chiếc váy cưới đẹp đẽ,
                        mà còn là tạo nên những trải nghiệm đặc biệt và ý nghĩa cho những người tìm kiếm sự hoàn hảo trong ngày cưới của họ:
                    </p>
                    <p>
                        <b>Tạo Ra Những Giấc Mơ Thực Tế:</b> NA Bridal cam kết biến những ước mơ của cô dâu thành hiện thực, nơi mọi người tìm thấy sự sáng tạo và chăm sóc cá nhân để tạo nên chiếc váy cưới độc đáo, phản ánh đẳng cấp và phong cách của từng khách hàng.
                    </p>
                    <p><b>Hỗ Trợ Tận Tâm và Chân Thật:</b> NA Bridal luôn lắng nghe khách hàng, đảm bảo rằng mỗi cặp đôi đều cảm thấy thoải mái và tự tin trong lựa chọn của mình.
                    </p>
                    <p>
                        <b>Tạo Nên Những Kỷ Niệm Đặc Biệt:</b> NA Bridal đặt sứ mệnh làm cho mỗi chiếc váy cưới không chỉ là trang phục, mà còn là một phần của kỷ niệm đáng nhớ. Bằng cách tạo ra những trải nghiệm mua sắm độc đáo và dịch vụ cá nhân, NA Bridal mong muốn mỗi cặp đôi sẽ mang theo những kỷ niệm đẹp nhất khi rời khỏi cửa hàng.
                    </p>
                    <p>NA Bridal - nơi mà mọi giấc mơ cưới trở nên sống động và ý nghĩa.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('js/home.js')}}"></script>
@endsection
