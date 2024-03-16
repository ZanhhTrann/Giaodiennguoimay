@php
    // session_start();
    // dd(session('login'));
    $user=new \App\Http\Controllers\UsersController();
    $prod=new \App\Http\Controllers\ProductsController();
    $shipC=new \App\Http\Controllers\ShippingController();
    $ships=$shipC->getShippings();
    $tmp_sum_total=0;
    $cart=$user->getCart();
@endphp
<form class="cart_info" method="POST" action="{{route('UpdateCart')}}" method="GET">
    @csrf
    <div class="cart_info_content">
        <table class="cart_info-table">
            <tr class="table_head">
                <th class="column-1">
                    <div class="row1">
                    <input type="checkbox" class="custom-checkbox" id="selectAll" value="all">
                    Product
                    </div>
                </th>
                <th class="column-2"></th>
                <th class="column-3">Size</th>
                <th class="column-4">Color</th>
                <th class="column-5">Price</th>
                <th class="column-6">Quantity</th>
                <th class="column-7">Total</th>
            </tr>
            @if(count($cart)>0)
                @foreach($cart as $item)
                    @php
                        $product=$prod->getProductbyId($item->Pid);
                        $sizes = array_filter(explode("|end|",$product->Sizes));
                        $Colors = array_filter(explode("|end|",$product->Colors));
                    @endphp
                    <tr class="table_row">
                        <th class="column-1">
                            <div class="row1">
                                <input type="checkbox" id="check_{{$item->UCid}}" class="custom-checkbox product-checkbox" value="{{$item->UCid}}">
                                <a class="img_item"
                                href="{{route('DelelteProductCart',['UCid'=>$item->UCid])}}">
                                    <img alt="" width="60px" height="80px"
                                    src="{{$product->Main_image}}">
                                </a>
                            </div>
                        </th>
                        <th class="column-2">
                            <a href="{{route('productDetail',['Pid'=>$product->Pid])}}">
                                <p style=" margin-top: 4px;
                                width: 165px;
                                white-space: nowrap;
                                overflow: hidden !important;
                                text-overflow: ellipsis;">
                                    {{$product->Product_name}}
                                </p>
                            </a>
                        </th>
                        <th class="column-3">
                            <select name="size_id[]" id="sizeSec_{{$item->UCid}}" style="border-radius: 5px" onchange="updateSize('{{$item->UCid}}')">
                                <option value="{{$item->size}}}">{{$item->size}}</option>
                                @if(count($sizes)>0)
                                    @foreach ($sizes as $size)
                                        @if($size!="dc"&&$size!=$item->size)
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
                            <input type="hidden" name="sizes[]" value="{{$item->size}}" id="sizeInput_{{$item->UCid}}">

                        </th>
                        <th class="column-4">
                            <select name="color_id[]" id="colorSec_{{$item->UCid}}" style="border-radius: 5px" onchange="updateColor('{{$item->UCid}}')">
                                <option value="{{$item->color}}}">{{$item->color}}</option>
                                @if(count($Colors)>0)
                                    @foreach ($Colors as $color)
                                        @if($color!="dc"&&$color!=$item->size)
                                            <option value="{{$color}}">
                                                {{$color}}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="null" selected>
                                        Null
                                    </option>
                                @endif
                            </select>
                            <input type="hidden" name="colors[]" value="{{$item->color}}" id="colorInput_{{$item->UCid}}">
                        </th>
                        <th class="column-5"><span id="price_{{$item->UCid}}">{{$product->Price}}</span></th>
                        <!-- Thêm class và id cho các phần tử -->
                        <th class="column-6">
                            <div class="num_product">
                                <div class="btn_num_product-down" onclick="decreaseQuantity('{{$item->UCid}}')">
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                                <input name="{{$item->UCid}}" value="{{$item->quantity}}" type="number" class="input_num_product " id="quantityInput_{{$item->UCid}}">
                                <div class="btn_num_product-up" onclick="increaseQuantity('{{$item->UCid}}')">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <input type="hidden" name="quantities[]" value="{{$item->quantity}}" id="quantityInputHiden_{{$item->UCid}}">
                                <!-- Thêm trường input ẩn cho UCid -->
                                <input type="hidden" name="ucids[]" value="{{$item->UCid}}">
                            </div>
                        </th>
                        <th class="column-7" >
                            <span id="total_{{$item->UCid}}" style=" display: inline-block;
                            width: 165px;
                            white-space: nowrap;
                            overflow: hidden !important;
                            text-overflow: ellipsis;">
                            {{$item->quantity*$product->Price}}
                            </span></th>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
    <div class="cart_interact">
        <div class="cart_interact_update">
            <button type="submit" class="update_btn btn">
                UPDATE CART
            </button>
        </div>
    </div>
</form>
<div class="cart_totals">
    <div class="cart_totals-contents">
        <h4>CART TOTALS</h4>
        <div class="subtotal">
            <div class="subtotal_title">Subtotal:</div>
            <div class="subtotal_price">{{"$ ".$tmp_sum_total}}</div>
        </div>
        <div class="shipping">
            <div class="shipping_title">Shipping:</div>
            <select name="size_ship"  id="shippingSelect" style="border-radius: 5px" onchange="updateTotal()">
                @foreach ($ships as $key => $ship)
                    <option value="{{$ship->SMid}}" data-price="{{$ship->price}}" {{ $key === 1 ? 'selected' : '' }}>
                        {{$ship->Shipping_methods_name.": $ ".$ship->price}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="total">
            <div class="total_title">Total:</div>
            <div class="total_price" id="totalPrice">{{"$ ".($tmp_sum_total+1)}}</div>
        </div>
        <div>
            <a class="checkout_btn btn">PROCEED TO CHECKOUT</a>
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
        const sizeInput = document.getElementById('sizeInput_' + UCid);
        sizeInput.value = sizeSelect.value;
    }

    function updateColor(UCid) {
        const colorSelect = document.getElementById('colorSec_' + UCid);
        const colorInput = document.getElementById('colorInput_' + UCid);
        colorInput.value = colorSelect.value;
    }

    function updateQuantity(UCid) {
        const quantityInput = document.getElementById('quantityInput_' + UCid);
        const quantityHidden = document.getElementById('quantityInputHiden_' + UCid);
        quantityHidden.value = quantityInput.value;
    }


    function updateTotal() {
        // Lấy giá trị được chọn từ phần tử select
        var selectedValue = parseFloat(document.getElementById("shippingSelect").options[document.getElementById("shippingSelect").selectedIndex].getAttribute('data-price'));

        const subtotalPrice = document.querySelector('.subtotal_price');

        // Lấy phần tử hiển thị tổng giá trị
        var totalElement = document.getElementById("totalPrice");

        // Cập nhật tổng giá trị dựa trên giá trị được chọn
        totalElement.textContent = "$ " + parseFloat(parseFloat((subtotalPrice.textContent).replace('$ ', '')) +parseFloat(selectedValue));
    }
    //
    function increaseQuantity(UCid) {
        const quantityInput = document.getElementById('quantityInput_' + UCid);
        const total = document.getElementById('total_' + UCid);
        const price = document.getElementById('price_' + UCid);
        var old = parseFloat((total.textContent).replace('$ ', '')).toFixed(2);
        const currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
        // console.log()
        total.textContent ="$ "+ ((currentQuantity+1) * parseFloat(price.textContent)).toFixed(2);
        var newp=parseFloat((total.textContent).replace('$ ', '')).toFixed(2);
        update(UCid, old,newp);
    }

    function decreaseQuantity(UCid) {
        const quantityInput = document.getElementById('quantityInput_' + UCid);
        const total = document.getElementById('total_' + UCid);
        const price = document.getElementById('price_' + UCid);
        var old = parseFloat((total.textContent).replace('$ ', '')).toFixed(2);
        const currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            total.textContent ="$ "+ ((currentQuantity-1) * parseFloat(price.textContent)).toFixed(2);
            var newp=parseFloat((total.textContent).replace('$ ', '')).toFixed(2);
            update(UCid, old,newp);
        }
    }

    function update(UCid, old, newp) {
        var selectedValue = parseFloat(document.getElementById("shippingSelect").value);
        var check = document.getElementById('check_' + UCid);
        var subtotalPrice = document.querySelector('.subtotal_price');
        var totalPrice = document.querySelector('.total_price');

        // Chuyển đổi old và newp thành số thực
        old = parseFloat(old);
        newp = parseFloat(newp);
        updateQuantity(UCid);
        // Kiểm tra xem old và newp có giá trị hợp lệ không
        if (!isNaN(old) && !isNaN(newp)) {
            if (check.checked) {
                // Cập nhật giá trị subtotalPrice và totalPrice
                var currentSubtotal = parseFloat(subtotalPrice.textContent.replace('$ ', ''));
                subtotalPrice.textContent = "$ " + (currentSubtotal - old + newp).toFixed(2);
                totalPrice.textContent = "$ " + (currentSubtotal - old + newp + selectedValue).toFixed(2);
            }
        }
    }


    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('selectAll');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const subtotalPrice = document.querySelector('.subtotal_price');
        const totalPrice = document.querySelector('.total_price');
        const checkoutBtn = document.querySelector('.checkout_btn');
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
            var selectedValue = parseFloat(document.getElementById("shippingSelect").options[document.getElementById("shippingSelect").selectedIndex].getAttribute('data-price'));
            let sumTotal = 0;
            productCheckboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    const quantity = parseInt(checkbox.closest('.table_row').querySelector('.input_num_product').value);
                    const price = parseFloat(checkbox.closest('.table_row').querySelector('.column-5').textContent);
                    sumTotal += quantity * price;
                }
            });
            subtotalPrice.textContent = "$ " + sumTotal.toFixed(2);
            totalPrice.textContent = "$ " + (sumTotal + selectedValue).toFixed(2);
        }

        checkoutBtn.addEventListener('click', function () {
            const selectedUCids = getSelectedUCids();
            const shippingSelect = document.getElementById('shippingSelect').value;
            console.log(selectedUCids,shippingSelect);
            if(selectedUCids.length===0){
                alert('Vui lòng chọn đồ muốn thanh toán.');
            }else{
                axios.post('/pay', {
                        selectedUCids: selectedUCids,
                        shippingSelect: shippingSelect
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
            // Gửi thông tin đến route

        });
        // Hàm cập nhật tổng giá trị
    });
</script>
