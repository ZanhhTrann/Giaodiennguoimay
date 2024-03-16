@php
    // session_start();
    // dd(session('login'));
    $user=new \App\Http\Controllers\UserController();
    $prod=new \App\Http\Controllers\ProductsController();
    $shipC=new \App\Http\Controllers\ShippingController();
    $payC=new \App\Http\Controllers\PaymentController();
    $orderDs=$payC->getOrderDetail();
    $ships=$shipC->getShippings();
@endphp
<div class="cart_info_content">
    <table class="cart_info-table">
        <tr class="table_head">
            <th class="column-0">Mã hóa đơn</th>
            <th class="column-1">Sản phẩm</th>
            <th class="column-2"></th>
            <th class="column-3">Size</th>
            {{-- <th class="column-4">Color</th> --}}
            <th class="column-5">Giá</th>
            <th class="column-6">Số lượng</th>
            <th class="column-7">Tổng</th>
            <th class="column-8">Trạng thái</th>
            <th class="column-9">Ngày đặt</th>
            <th class="column-10">Ngày cập nhập</th>
            <th class="column-11"></th>

        </tr>
        @if(count($orderDs)>0)
            @foreach($orderDs as $item)
                @php
                    $product=$prod->__getProductByPid($item->Pid);
                    $status=$payC->getOrderStatusById($item->ODid);
                    // dd($status[0]->Status);
                @endphp
                <tr class="table_row">
                    <th class="column-0">
                        {{"#BOD0".$item->Oid}}

                    </th>
                    <th class="column-1">
                        <div class="row1">

                            <img alt="" width="60px" height="80px"
                            src="data:image/jpeg;base64,{{ base64_encode($product->Main_image)}}">
                        </div>
                    </th>
                    <th class="column-2">
                        <a href="{{route('billDetail',['Oid'=>$item->Oid,'ODid'=>$item->ODid,'Pid'=>$product->Pid])}}">
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
                        <span>{{$item->size}}</span>
                    </th>
                    <th class="column-5"><span id="price_{{$item->UCid}}">{{number_format($product->Price, 0, ',', '.')}}</span> VND</th>
                    <!-- Thêm class và id cho các phần tử -->
                    <th class="column-6">
                        <span>{{$item->Quantily}}</span>
                    </th>
                    <th class="column-7">
                        <span>{{number_format($product->Price*$item->Quantily, 0, ',', '.')}}</span> VND
                    </th>
                    <th class="column-8">
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
                    </th>
                    <th class="column-9">
                        @php
                        $dateTime=new DateTime($item->created_at);
                        @endphp
                        <span>{{$dateTime->format('Y-m-d')}}</span>
                    </th>
                    <th class="column-10">
                        @php
                        $dateTime=new DateTime($item->updated_at);
                        @endphp
                        <span>{{$dateTime->format('Y-m-d')}}</span>
                    </th>
                    <th class="column-11">
                        @if ($status->Status == 0)
                        <div class="header_cart-container_btns">
                            <a href="{{route('cancelOrder',['ODid'=>$item->ODid])}}" class="btn">Hủy</a>
                        </div>
                        @endif
                        @if($status->Status == 2)
                        <div class="header_cart-container_btns">
                            <a href="{{route('sucssetOrder',['ODid'=>$item->ODid])}}" class="btn">Đã Nhận Hàng </a>
                        </div>
                        @endif
                    </th>
                </tr>
            @endforeach
        @endif
    </table>
</div>
