@php
    // session_start();
    // dd(session('login'));
    $userC=new \App\Http\Controllers\UserController();
    $user=$userC->getUser();
    $prod=new \App\Http\Controllers\ProductsController();
    $shipC=new \App\Http\Controllers\ShippingController();
    $payC=new \App\Http\Controllers\PaymentController();
    $citys=$payC->getCity();
    // dd(session('payment'));
    // Session::forget('payment');
    $cartOrders=$userC->getCartOrder();
    $payMets=$payC->getPayMethod();
    // dd($cartOrders);
    $ships=$shipC->getShippings();
    $sum_total=0;
    $cart=$userC->getCart();
    $uAddress=$user->Address;
@endphp
<form action="{{route('payment')}}" method="POST" id="payment" class="section_features-pay">
    @csrf
        <div class="container">
            <div class="bill_info">
                <h4>Thông tin đơn hàng</h4>
                <div class="Recipient_name">
                    <p for="">Tên khách hàng:</p>
                    <input type="text" id="RecName" name="name" required value="{{$user->Name}}">
                </div>
                <div class="phone_number">
                    <label for="phone">Số điện thoại:</label>
                    <input id="phone" type="text"  name="phone" required value={{$user->Phone_number}}>
                </div>
                <div class="delivery_address">
                    <span>Địa chỉ nhận hàng</span>
                    <div class="delivery_address-item">
                        <div class="address_item city">
                            <div>Tỉnh/Thành phố:</div>
                            <select name="id_tp" id="city"  onchange="changeCity()"  {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                                <option value="">--Chọn tỉnh/thành phố--</option>
                                @if(count($citys)>0)
                                    @foreach ($citys as $key => $value)
                                        <option value="{{$value->id_tp}}">
                                            {{$value->name_tp}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="address_item district">
                            <div>Quận/Huyện:</div>
                            <select name="id_qh" id="district"  {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                                <option value="">--Chọn quận/huyện--</option>
                            </select>
                        </div>
                        <div class="address_item town">
                            <div>Thị trấn/xã/phường:</div>
                            <select name="id_xp" id="town"  {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                                <option value="">--Chọn thị trấn/xã/phường--</option>
                            </select>
                        </div>
                        <div class="address_item street">
                            <div>Đường:</div>
                            <input type="text" id="street" name="street" placeholder="--Nhập đường--" {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                        </div>
                        <div class="address_item address">
                            <div>Địa chỉ cụ thể:</div>
                            <textarea name="address" id="detail">{{$uAddress}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="notes">
                    <label for="">Note</label>
                    <textarea name="note" id=""></textarea>
                </div>
            </div>
            <div class="order_info">
                <h4>Sản phẩm đặt mua</h4>
                <div class="order_title">
                    <div>Sản phẩm</div>
                    <div>Tạm tính</div>
                </div>
                <div class="order_product">
                    @if($cartOrders)
                        @foreach($cartOrders as $item)
                            @php
                                $product=$prod->__getProductByPid($item->Pid);
                                $sum_total+=$product->Price*$item->quantity;
                            @endphp
                            <div class="order_product-item">
                                <div class="name_quantity">
                                    <span>{{$product->Product_name}}</span>
                                </div>
                                <span> {{$item->size}}</span>
                                <span>x {{$item->quantity}}</span>
                                <div id="price">{{number_format($product->Price*$item->quantity, 0, ',', '.')}} VND</div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="order_shipping">
                    <input type="hidden" name="ship_id" id="SSMid" value="">
                    <div>Shipping:
                        <select name="ship" class="size" id="Shipping_choose" style="border-radius: 5px" onchange="updateShip()">
                            <option value="0">--Chọn hình thức ship--</option>
                            @if(count($ships)>0)
                                @foreach ($ships as $ship)
                                    @if($ship!=$item->ship)
                                        <option data-id="{{$ship->SMid}}" value="{{$ship->price}}">
                                            {{$ship->Shipping_methods_name}}
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
                    <div id="ship_price">0 VND</div>
                </div>
                <div class="order_total">
                    <div>Tổng:</div>
                    <input id="inputTotal" type="hidden" name="total" value="">
                    <input type="hidden" id="Ptotal" value="{{$sum_total}}">
                    <div id="total_price">{{number_format($sum_total, 0, ',', '.')}} VND</div>
                </div>
                @foreach($payMets as $key=>$item)
                    <div class="order_radio">
                        <input id="cash_{{$item->PMid}}}" name="payment_method" type="radio" {{($key==0)?'checked':''}} value="{{$item->PMid}}">
                        <label for="cash">{{$item->Payment_method_name.": ".$item->Discription}}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn" id="buy">Đặt hàng</button>
            </div>
        </div>
</form>
<script>
     document.getElementById('payment').addEventListener('submit', function(event) {

        // Kiểm tra xem có sản phẩm nào được chọn không
        event.preventDefault();
        const select = document.getElementById('Shipping_choose');
        // const shippingSelect = document.getElementById('shippingSelect').value;
        // console.log(getSelectedUCids());
        if(select.value ==0){
            alert('Vui lòng chọn đồ muốn thanh toán !');
        }else{
            this.submit();
        }
    });
    // hàm cập nhập lại giá tiền sau khi chon ship
function updateShip() {
    const select = document.getElementById('Shipping_choose');
    const shipP = document.getElementById('ship_price');
    const total = document.getElementById('total_price');
    const productP = document.getElementById('Ptotal');
    const SSMid = document.getElementById('SSMid');
    const inputTotal = document.getElementById('inputTotal');
    const selectedOption = select.options[select.selectedIndex];
    const SMid = selectedOption.dataset.id;
    console.log(SMid);
    SSMid.value=SMid;
    console.log(SSMid.value);
    // Lấy giá trị của phí vận chuyển và giá sản phẩm, chuyển đổi sang dạng số
    const shippingPrice = parseFloat(select.value);
    const productPrice = parseFloat(productP.value);

    console.log(shippingPrice, productPrice);

    // Cập nhật giá trị vận chuyển và tổng giá trị
    shipP.textContent = shippingPrice.toLocaleString('vi-VN') + ' VND';
    total.textContent = (shippingPrice + productPrice).toLocaleString('vi-VN') + ' VND';
    inputTotal.value=(shippingPrice + productPrice);
}


    function AddressChange() {
        // Lấy giá trị của thành phố (city), quận huyện (district), xã phường (town), và đường (street)
        var city = $('#city option:selected').text().trim();
        if(city==='--Chọn tỉnh/thành phố--'){
            city=''
        }
        var district = $('#district option:selected').text().trim();
        if(district==='--Chọn quận/huyện--'){
            district=''
        }
        var town = $('#town option:selected').text().trim();
        if(town==='--Chọn thị trấn/xã/phường--'){
            town=''
        }
        var street = $('#street').val().trim();

        // Tạo một mảng chứa các thành phần không rỗng
        var addressComponents = [street, town, district, city].filter(function (component) {
            return component !== "";
        });

        // Cập nhật chi tiết địa chỉ
        $('#detail').val(addressComponents.join(", "));
    }

    function changeCity() {
        var cityId = $('#city').val();
        // console.log(cityId);
        if (cityId) {
            $.ajax({
                url: "{{ route('getDistrict') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cityId: cityId
                },
                success: function(data) {
                    // console.log(data);
                    $('#district').html(data);
                    AddressChange();
                }
            });
        } else {
            // Xử lý khi không có thành phố được chọn
            $('#town').html('<option value="">-- Chọn quận/huyện --</option>');
        }
    }
    $(document).ready(function () {

    // Lắng nghe sự kiện khi một danh mục được chọn
    $('body').on('change', '#district', function() {
        var districtId = $('#district').val();
        if (districtId) {
            $.ajax({
                url: "{{ route('getTown') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    districtId: districtId
                },
                success: function(data) {
                    // console.log(data);
                    $('#town').html(data);
                    AddressChange();
                }
            });
        } else {
            // Xử lý khi không có thành phố được chọn
            $('#town').html('<option value="">-- Chọn quận/huyện --</option>');
        }
    });
    $('body').on('change', '#town', function() {
        AddressChange();
    });

});
</script>

