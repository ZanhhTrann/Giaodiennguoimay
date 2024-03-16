<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>DANH MỤC</h4>
                <ul>
                    <li><a href="">Váy cưới công chúa</a></li>
                    <li><a href="">Váy cưới đơn giản</a></li>
                    <li><a href="">Váy cưới hở vai</a></li>
                    <li><a href="">Giày cưới</a></li>
                    <li><a href="">Trang chủ</a></li>
                </ul>
            </div>
            <div class="col">
                <h4>HỖ TRỢ</h4>
                <ul>
                    <li clash="{{ (session('head_pages') == 'track') ? 'active' : '' }}"><a  href="{{route('helps',['page'=>'track'])}}">Đơn hàng</a></li>
                    <li clash="{{ (session('head_pages') == 'returns') ? 'active' : '' }}"><a href="{{route('helps',['page'=>'returns'])}}">Đổi trả</a></li>
                    <li clash="{{ (session('head_pages') == 'shipping') ? 'active' : '' }}"><a  href="{{route('helps',['page'=>'shipping'])}}">Shipping</a></li>
                    <li clash="{{ (session('head_pages') == 'faqs') ? 'active' : '' }}"><a  href="{{route('helps',['page'=>'faqs'])}}">FAQs</a></li>
                </ul>
            </div>
            <div class="col">
                <h4>LIÊN HỆ</h4>
                <p>
                    Khoa Công nghệ thông tin - Phenikaa-Uni:
                    <br>
                    Trần Công Danh - 20010760
                    <br>
                    Nguyễn Văn Tân - 20010922
                    <br>
                    Nguyễn Ánh Ngọc - 20010789
                    <br>
                    Dương Văn Quang - 20010793
                     </p>
                <div class="follow">
                    <a class="icon" target="_blank"
                    href="https://www.facebook.com/TCZnn.02/">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a class="icon" target="_blank"
                    href="" >
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a class="icon" target="_blank"
                    href="https://github.com/ZanhhTrann/DALN_WEB_LARAVEL">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
            </div>
            <div class="col">
                <h4>Về CHÚNG TÔI</h4>
                <p>
                    NA Bridal không chỉ là nơi để bạn
                    chọn lựa bộ trang phục cưới hoàn
                    hảo, mà còn là điểm đến để trải nghiệm
                    không khí ấm áp và chuyên nghiệp.
                    Chúng tôi hiểu rằng mỗi cặp đôi là
                    duyên phận độc đáo, và vì vậy, chúng tôi
                    tận tâm tạo ra những thiết kế độc đáo,
                    phản ánh đẳng cấp và phong cách
                    riêng biệt của từng người.
                </p>
            </div>
        </div>

        <div class="footer_rights">
            <p>GIAO DIEN NGUOI MAY MAKE BY DQNT</p>
        </div>
    </div>
</footer>
<div class="btn_back-to-top">
    <div class="icon">
        <i class="fa-solid fa-angle-up"></i>
    </div>
</div>

