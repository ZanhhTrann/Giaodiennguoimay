@php
    $sizes = array_filter(explode("_",$product->Sizes));
    $payC=new \App\Http\Controllers\PaymentController();
    $status=$payC->getOrderStatusById($detail->ODid);
    $check=false;
@endphp
<div class="overlay_quick_view" id="QV">
    <div class="container">
        <div class="quick_view_content">
            <div class="close_quick_view">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="quick_view_content-detail" id="QV_detail">
                <div class="detail_img swiper">
                    <div class="swiper-wrapper">
                        <div class="slide_banner swiper-slide">
                            <img src="data:image/jpeg;base64,{{ base64_encode($product->Main_image)}}" alt="">
                        </div>
                    </div>
                </div>
                <!-- detail_info -->
                <div class="detail_info">
                    <div class="item_detail-name">
                        <div class="name" style="text-transform:capitalize;">
                            {{$product->Product_name}}
                        </div>
                        <span class="head_icons">
                            <a href="{{route('updateFavorite',['Pid'=>$product->Pid])}}" class="icon {{ (session('login') && $check ? 'active' : '')}}">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            <a href="#"><i class="fas fa-share"></i></a>
                        </span>
                    </div>
                    <div class="QiS {{$product->Quantit_in_stock>0? 'stocking': 'oft'}}">
                        @if((int)($status->Status)==(0))
                            <span>Đang duyệt</span>
                        @endif
                        @if((int)($status->Status)==1)
                            <span>Đã hoàn thành</span>
                        @endif
                        @if((int)($status->Status)==2)
                            <span>Đã được duyệt</span>
                        @endif
                        @if((int)($status->Status)==(-1))
                            <span>Đã bị hủy bởi bạn</span>
                        @endif
                        @if((int)($status->Status)==(-2))
                            <span>Đã bị hủy bởi Admin</span>
                        @endif
                    </div>
                    <div class="description">{{$product->Short_des}}</div>
                    <div class="detail_price">
                        Giá mua
                        <span class="price">{{ number_format($product->Price, 0, ',', '.') }} VND</span>
                        <div class="Note">Liên hệ với chúng tôi để được tư vấn thêm!</div>
                        <form action="{{ route('addCart',['Pid'=>$product->Pid]) }}" method="POST" id="addToCartForm" required>
                            @csrf
                            <div class="Note-rent">Khách hàng muốn thuê trang phục vui lòng đến cửa hàng!</div>
                            <div class="btn_zone">
                                <div class="header_cart-container_btns">
                                    <a href="{{route('cancelOrder',['ODid'=>$detail->ODid])}}" class="btn">Hủy</a>
                                </div>
                                <div class="header_cart-container_btns">
                                    <a href="{{route('sucssetOrder',['ODid'=>$detail->ODid])}}" class="btn">Đã Nhận Hàng </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- detail_img -->

<script>
    document.getElementById('addToCartForm').onsubmit = function() {
        var sizeSelect = document.getElementsByName('size_id')[0];
        var colorSelect = document.getElementsByName('color_id')[0];

        if (sizeSelect.value === '#' || colorSelect.value === '#') {
            alert('Vui lòng chọn kích thước và màu trước khi thêm vào giỏ hàng.');
            return false; // Ngăn chặn gửi form nếu thông tin không hợp lệ
        }
        return true;
    };
</script>



