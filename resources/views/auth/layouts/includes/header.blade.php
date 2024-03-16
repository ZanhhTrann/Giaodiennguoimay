
@php
    session_start();
    $prod=new \App\Http\Controllers\ProductsController();
    if(session('login')){
        $user=new \App\Http\Controllers\UserController();
        $cart=$user->getCart();
        $favorite=$user->getFavorite();
    }
    $total=0;
@endphp
{{-- <header id="header" class="header_home"> --}}
<header id="header" class="{{ $head_page == 'home'? 'header_home' : 'headerhome' }}">
    <div class="container">
        <a href="{{ route('pages.index', ['page' => 'home']) }}" class="header_logo">
            <b>NA</b>BRIDAL
        </a>
        <ul class="header_menu">
            <li class="item products {{ $head_page == 'home' ? 'active' : '' }}">
                <a href="{{ route('pages.index', ['page' => 'home']) }}">Trang chủ</a>
            </li>
            <li class="item products {{ $head_page == 'shop' ? 'active' : '' }}">
                <a href="{{ route('pages.index', ['page' => 'shop']) }}">Trang phục cưới</a>
            </li>
            <li class="item products {{ $head_page == 'about' ? 'active' : '' }}">
                <a href="{{ route('pages.index', ['page' => 'about']) }}">Giới thiệu</a>
            </li>
            <li class="item about {{ $head_page == 'contact' ? 'active' : '' }}">
                <a href="{{route('pages.index',['page'=>'contact'])}}">Liên hệ</a>
            </li>
            <li class="item contact {{ $head_page == 'orders' ? 'active' : '' }}">
                <a href="{{route('pages.index',['page'=>'orders'])}}">Đơn hàng</a>
            </li>
            <li class="item contact {{ $head_page == 'custom' ? 'active' : '' }}">
                <div class="icon">
                    <a href="{{route('pages.index',['page'=>'custom'])}}">Đặt theo yêu cầu</a>
                    <div class="icon_quantity">New</div>
                </div>
            </li>
            <li></li>
        </ul>
        <div class="header_nav">
            @if(!session('login'))
            <a href="{{route('pages.index',['page'=>'signup'])}}" class="login">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                LOGIN
            </a>
            @else
                <div class="user_info">
                    <div class="user_info-img">
                        @if($user->getAvata()!=null)
                            <img src="data:image/jpeg;base64,{{$user->getAvata()}}" alt="">
                        @else
                            <img src="{{asset('imgs/logo_website.png')}}" alt="">
                        @endif
                    </div>
                    <div class="user_info-name">
                        {{session('login')['user_name']}}
                    </div>
                    <ul class="user_nav">
                        <li><a href="{{route('pages.index',['page'=>'profile'])}}">
                            <div class="icon">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            Your profile
                        </a></li>
                        <li><a href="{{route('signout')}}">
                            <div class="icon">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>
                            Sign out
                        </a></li>
                    </ul>
                </div>
            @endif
            <!-- ============== -->
            <div class="icon search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="icon cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="icon_quantity">
                    @if(session('login'))
                        {{count($cart)}}
                    @else
                        {{0}}
                    @endif
                </div>
            </div>
            <div class="icon heart">
                <i class="fa-solid fa-heart"></i>
                <div class="icon_quantity">
                    @if(session('login'))
                        {{count($favorite)}}
                    @else
                        {{0}}
                    @endif
                </div>
            </div>
            <div class="icon bars">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </div>

    <div class="header_search">
        <form class="container" method="POST" id="searchForm" action="{{ route('search') }}">
            @csrf
            <div class="icon-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <button class="btn_icon-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input type="text" id="searchInput" name="search" placeholder="Search..." required>
        </form>

    </div>
</header>

<!-- overlay -->
<div class="header_cart overlay">
    <div class="header_cart-container">
        <div class="header_cart-container_title">

            <span>Giỏ hàng</span>
            <div class="icon">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="select_zone">
            <input type="checkbox" class="custom-checkbox" id="selectAll" value="all">
            <h5>Chọn tất cả</h5>
        </div>
        <div class="container">
            @if(session('login') && (count($cart)> 0))
                <ul class="header_cart-container_list">
                    @foreach ($cart as $item)
                        @php
                            $product=$prod->__getProductByPid($item->Pid);
                            $sizes = array_filter(explode("_",$product->Sizes));
                            $total+=($product->Price)*($item->quantity);
                        @endphp
                        <li>
                            <input type="checkbox" id="check_{{$item->UCid}}" class="custom-checkbox product-checkbox" value="{{$item->UCid}}">
                            <a class="item_img_head"
                            href="{{route('deleteCart',['UCid'=>$item->UCid])}}">
                            <img src="data:image/jpeg;base64,{{ base64_encode($product->Main_image)}}" alt="">
                            </a>

                            <div class="item_info">
                                <a href="{{route('productDetail',['Pid'=>$product->Pid])}}"
                                class="info_name">{{$product->Product_name}}</a>
                                <div class="info_size">
                                    Size:
                                    <select name="size_id[]" class="size" id="sizeSec_{{$item->UCid}}" style="border-radius: 5px" onchange="updateSize('{{$item->UCid}}')">
                                        <option value="{{$item->size}}}">{{$item->size}}</option>
                                        @if(count($sizes)>0)
                                            @foreach ($sizes as $size)
                                                @if($size!=$item->size)
                                                    <option value="{{$size}}">
                                                        {{$size}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="null" selected>
                                                Null
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                <div class="info_number">
                                    <div class="change_dec">
                                        Số lượng:
                                        <div class="btn_num_product-down" onclick="decreaseQuantity('{{$item->UCid}}')">
                                            <i class="fa-solid fa-minus"></i>
                                        </div>
                                        <input name="{{$item->UCid}}" value="{{$item->quantity}}" type="number" class="input_num_product " id="quantityInput_{{$item->UCid}}">
                                        <div class="btn_num_product-up" onclick="increaseQuantity('{{$item->UCid}}')">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                    </div>
                                    Giá: <span id="price_{{$item->UCid}}" class="price">{{number_format($product->Price, 0, ',', '.')}}</span> VND<br>
                                    Tổng: <span id="total_{{$item->UCid}}" class="price">{{number_format($product->Price*$item->quantity, 0, ',', '.')}}</span> VND
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="interact">
                    <div class="header_cart-container_total">
                        Tạm tính:
                        <span id="totalChoose">
                            0 VND
                        </span>
                    </div>
                    <div class="header_cart-container_btns">
                        <a class="checkout_btn btn" id="checkoutButton">Mua hàng</a>
                    </div>
                </div>
            @else
                <div class="no_cart">
                    <h3>Giỏ hàng của bạn hiện đang trống</h3>
                    <img src="{{asset('imgs/empty_cart.png')}}" alt="">
                </div>
            @endif
        </div>
    </div>
</div>

<!-- wishlist -->
<div class="wishlist overlay">
    <div class="wishlist-container">
        <div class="wishlist-container_title">
            <span>Sản phẩm yêu thích</span>
            <div class="icon">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="container">
            @if(session('login') && (count($favorite)> 0))
            <ul class="wishlist-container_list">
                @foreach($favorite as $item)
                    @php
                        $product=$prod->__getProductByPid($item->Pid);
                    @endphp
                    <li>
                        <a class="item_img_head"
                        href="{{route('updateFavorite',['Pid'=>$product->Pid])}}">
                        <img src="data:image/jpeg;base64,{{ base64_encode($product->Main_image)}}" alt="">
                        </a>
                        <div class="item_info">
                            <a href="{{route('productDetail',['Pid'=>$product->Pid])}}"
                            class="info_name">{{$product->Product_name}}</a>
                            <div class="info_number">
                                Giá Thuê: <br>
                                <span class="price">
                                    {{ number_format($product->Rent_cost, 0, ',', '.')}}
                                </span>VND<br>
                                Giá Mua: <br>
                                <span class="price">
                                    {{ number_format($product->Price, 0, ',', '.') }}
                                </span> VND
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <div class="no_cart">
                    <h3>Danh sách yêu thích của bạn hiện đang trống</h3>
                    <img src="{{asset('imgs/empty_cart.png')}}" alt="">
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    //
    let selectedUCids = [];

    function updateSelectedUCids(UCid, isChecked) {
        // Kiểm tra xem UCid đã tồn tại trong mảng hay chưa
        const index = selectedUCids.indexOf(UCid);

        if (isChecked) {
            // Nếu checkbox được chọn và UCid chưa tồn tại trong mảng, thêm UCid vào mảng
            if (index === -1) {
                selectedUCids.push(UCid);
            }
        } else {
            // Nếu checkbox không được chọn và UCid tồn tại trong mảng, loại bỏ UCid khỏi mảng
            if (index !== -1) {
                selectedUCids.splice(index, 1);
            }
        }
    }

    // Hàm để lấy mảng các UCid đã chọn
    function getSelectedUCids() {
        return selectedUCids;
    }

    function updateSize(UCid) {
        const sizeSelect = document.getElementById('sizeSec_' + UCid);
        console.log(sizeSelect.value);
        $.ajax({
            url: "{{ route('updateSize') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                UCid: UCid,
                size: sizeSelect.value
            },
            success: function (data) {
                // Ẩn hiệu ứng loading khi nhận được response
                console.log(data);
            },
            error: function () {
                // Xử lý khi có lỗi
            }
        });
    }
    //
    function increaseQuantity(UCid) {
        const quantityInput = document.getElementById('quantityInput_' + UCid);
        const total = document.getElementById('total_' + UCid);
        const price = document.getElementById('price_' + UCid);
        const checkbox = document.getElementById('check_' + UCid);
        var old = parseFloat(total.textContent.replace(/\./g, ''));
        var pri =parseFloat(price.textContent.replace(/\./g, ''));
        const currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
        if(checkbox.checked){
            var oldTotal = parseFloat(document.getElementById('totalChoose').textContent.replace(/\./g, '').replace(' VND', ''));
            document.getElementById('totalChoose').textContent = (oldTotal+pri).toLocaleString() + ' VND';
        }
        total.textContent =(pri + old).toLocaleString().replace(/,/g, '.');
        var newp=parseFloat((total.textContent).replace('$ ', '')).toFixed(2);
        updateQuantity(UCid,quantityInput.value );
    }

    function decreaseQuantity(UCid) {
        const quantityInput = document.getElementById('quantityInput_' + UCid);
        const total = document.getElementById('total_' + UCid);
        const checkbox = document.getElementById('check_' + UCid);
        // console.log(checkbox.value,checkbox.checked);
        const price = document.getElementById('price_' + UCid);
        var old = parseFloat(total.textContent.replace(/\./g, ''));
        var pri =parseFloat(price.textContent.replace(/\./g, ''));
        // var old = parseFloat((total.textContent).replace('$ ', '')).toFixed(2);
        const currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            if(checkbox.checked){
                var oldTotal = parseFloat(document.getElementById('totalChoose').textContent.replace(/\./g, '').replace(' VND', ''));
                document.getElementById('totalChoose').textContent = (oldTotal-pri).toLocaleString() + ' VND';
            }
            total.textContent =(old-pri).toLocaleString().replace(/,/g, '.');
            // var newp=parseFloat((total.textContent).replace('$ ', '')).toFixed(2);
            updateQuantity(UCid,quantityInput.value );
        }

    }

    function updateQuantity(UCid, quantity) {
        $.ajax({
            url: "{{ route('updateQuantity') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                UCid: UCid,
                quantity: quantity
            },
            success: function (data) {
                // Ẩn hiệu ứng loading khi nhận được response
                console.log(data);
            },
            error: function () {
                // Xử lý khi có lỗi
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('selectAll');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const totalPrice = document.querySelector('.totalChoose');
        const checkoutBtn = document.querySelector('checkout_btn');
        //

        // Xử lý sự kiện khi chọn tất cả
        selectAllCheckbox.addEventListener('change', function () {
            const isChecked = this.checked;
            productCheckboxes.forEach(function (checkbox) {
                const UCid = checkbox.value;
                checkbox.checked = isChecked;
                updateSelectedUCids(UCid, isChecked);
            });
            updateTotal();
        });

        // Xử lý sự kiện khi chọn từng sản phẩm
        productCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const UCid = this.value;
                const isChecked = this.checked;
                updateSelectedUCids(UCid, isChecked);
                updateTotal();
            });
        });
        function updateTotal() {
            let sumTotal = 0;

            // Lặp qua từng sản phẩm trong giỏ hàng
            document.querySelectorAll('.custom-checkbox.product-checkbox').forEach(function(checkbox) {
                if (checkbox.checked) {
                    // Lấy UCid của sản phẩm
                    let UCid = checkbox.value;

                    // Lấy số lượng sản phẩm từ input
                    const quantity = parseInt(document.getElementById('quantityInput_' + UCid).value);

                    // Lấy giá của sản phẩm từ span
                    const price = parseFloat(document.getElementById('price_' + UCid).textContent.replace(/\./g, '').replace(' VND', ''));

                    // Tính tổng giá của sản phẩm và cộng vào tổng tổng giá của các sản phẩm đã chọn
                    sumTotal += quantity * price;
                }
            });

            // Hiển thị tổng giá của các sản phẩm đã chọn
            document.getElementById('totalChoose').textContent = sumTotal.toLocaleString() + ' VND';
        }

        document.getElementById('checkoutButton').addEventListener('click', function() {

            // Kiểm tra xem có sản phẩm nào được chọn không
            const selectedUCids = getSelectedUCids();
            // const shippingSelect = document.getElementById('shippingSelect').value;
            // console.log(getSelectedUCids());
            if(selectedUCids.length===0){
                alert('Vui lòng chọn đồ muốn thanh toán !');
            }else{
                axios.post('/pay', {
                        selectedUCids: selectedUCids
                    })
                    .then(function(response) {
                        // Sau khi cập nhật session, bạn có thể thực hiện việc chuyển hướng trang hoặc làm bất kỳ việc gì khác.
                        window.location.href = response.data.redirectUrl;
                        console.log(shippingSelect);
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            }
        });
        // Hàm cập nhật tổng giá trị
    });
</script>
