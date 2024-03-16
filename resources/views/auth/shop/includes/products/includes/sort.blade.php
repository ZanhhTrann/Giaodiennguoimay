@php
    $prod=new \App\Http\Controllers\ProductsController();
    $user=new \App\Http\Controllers\UserController();
    if(session('login')){
        $favorite=$user->getFavorite();
    }
    $check=false;
        // dd(session('UserShop')
        // );
@endphp
@foreach($visible as $product)
    @php
        if(session('login')){
            foreach($favorite as $item){
                if($item->Pid==$product->Pid){
                    $check=true;
                    break;
                }
            }
        }
    @endphp
    <div class="products_list-item ">
            <form class="product-form" method="POST" action="{{ route('getQuickView') }}">
                @csrf
                <div class="item_img">
                    <img src="data:image/jpeg;base64,{{ base64_encode($product->Main_image)}}" alt="">
                    <button type="button" class="btn btn_view quick-view-button" data-product-id="{{$product->Pid}}">Xem nhanh</button>
                </div>
            </form>
            <div class="item_detail">
                <div class="item_detail-name">
                    <a href="{{route('productDetail',['Pid'=>$product->Pid])}}" style="text-transform:capitalize;">
                        {{$product->Product_name}}
                    </a>
                    <a href="{{route('updateFavorite',['Pid'=>$product->Pid])}}" class="icon {{ (session('login') && $check ? 'active' : '')}}">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                </div>
                <div class="item_detail-price">
                    <span>
                        {{ number_format($product->Rent_cost, 0, ',', '.') }} - {{ number_format($product->Price, 0, ',', '.') }}
                    </span> VND
                </div>
            </div>
    </div>
    @php
        $check=false;
    @endphp
@endforeach

