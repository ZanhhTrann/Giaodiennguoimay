@php
    $sizes = array_filter(explode("_",$product->Sizes));
    $proCont=new \App\Http\Controllers\ProductsController();
    $userCont=new \App\Http\Controllers\UserController();
    $ordersCont=new \App\Http\Controllers\OrdersController();
    // $user=new \App\Http\Controllers\UsersController();
    $Request=$proCont->getReviewsbyId($product->Pid);
    $reviews=$Request['reviews'];
    // // dd($reviews[0]);
    $users_name=$Request['users_name'];
    // $your_name='';
    // $your_rev='';
    // dd($users_name[0]);
    $catCont=new \App\Http\Controllers\CategoriesController();
    $cat=$catCont->__getCatByCid($product->Cid);
    $reCheck=false;
@endphp

<div class="tab_contents">
    <div class="container contents">
        <ul class="tab_list">
            <li class="active">Mô tả</li>
            <li class="">Thêm thông tin</li>
            <li class="">Đánh giá ({{empty($reviews)?0:count($reviews)}})</li>
        </ul>
        <div class="tab_item-contents">
            <div class="tab_item tab_desc active show">
                <p>
                   {{$product->Description}}
                </p>
            </div>
            <div class="tab_item tab_info ">
                <ul>
                    <li>
                        <span class="">Mã sản phẩm</span>
                        <span class="">#NA00{{$product->Pid}}</span>
                    </li>
                    <li>
                        <span class="">Loại sản phẩm</span>
                        <span class="">{{$cat->Categories_name}}</span>
                    </li>
                    @if($product->Cid==4052)
                        <li>
                            <span class="">Độ cao gót</span>
                            <span class="">7 cm</span>
                        </li>
                        <li>
                            <span class="">Màu sắc</span>
                            <span class="">Kem</span>
                        </li>
                    @else
                        <li>
                            <span class="">Vải chỉnh</span>
                            <span class="">Satin Bridal</span>
                        </li>
                    @endif
                    <li>
                        <span class="">Kích cỡ</span>
                        <span class="">
                            Form chuẩn có size
                            @foreach($sizes as $key=>$size)
                                @if(($key+1)!=count($sizes))
                                    {{$size.", "}}
                                @else
                                    {{$size}}
                                @endif
                            @endforeach
                        </span>
                    </li>
                </ul>
            </div>
            <div class="tab_item tab_reviews">
                <div class="tab_reviews-item">
                    <!-- LIST REVIEW USERS -->
                    <div class="frame_review">
                        <ul class="reviews-list">
                            @if(!empty($reviews))
                                @foreach($reviews as $key=>$review)
                                    @if(!session()->has('login')||$review->Uid!=session('login')['user_id'])
                                        <li>
                                            <div class="reviews_content">
                                                <div class="user_img">
                                                @if($userCont->getUsersAvata($review->Uid)!=null)
                                                    <img src="data:image/jpeg;base64,{{$userCont->getUsersAvata($review->Uid)}}" alt="">
                                                @else
                                                    <img src="{{asset('imgs/logo_website.png')}}" alt="">
                                                @endif
                                                </div>
                                                @php
                                                    $respone=$ordersCont->__getOrderByID($review->Pid,$review->Uid);
                                                    $order=$respone['order'];
                                                    $order_detail=$respone['order_detail'];
                                                    $order_status=$respone['order_status'];
                                                @endphp
                                                <div class="user_text">
                                                    <p class="name">{{$users_name[$key]->Name}}</p>
                                                    <p class="order_type type">
                                                        Hình thức: {{($order->Type==1? 'mua':($order->Type==2?'thuê':'Đặt thiết kế riêng'))}}
                                                    </p>
                                                    <p class="color_type type">
                                                        Màu sắc: sữa
                                                    </p>
                                                    <p class="size_type type">
                                                        Kích cỡ: {{$order_detail->size}}
                                                    </p>
                                                    <p class="comment">{{$review->reviews}}</p>
                                                </div>
                                            </div>
                                            <div class="review_img">
                                                @if($review->Img!=null)
                                                    <img src="data:image/jpeg;base64,{{ base64_encode($review->Img)}}" alt="">
                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <!-- FORM POST REVIEW -->
                    <div class="container">
                        @if(!session('login'))
                            <i class="warnning"> Hãy đăng nhập trước khi đánh giá sản phẩm! </i>
                        @else
                            @php
                                $payC=new \App\Http\Controllers\PaymentController();
                                $orderDs=$payC->getOrderDetail();
                                $check=false;
                                foreach ($orderDs as $key => $value) {
                                    if($product->Pid==$value->Pid){
                                        $check=true;
                                        break;
                                    }
                                }
                            @endphp
                            @if($check==true)
                                @if($reCheck==true)
                                    <i class="warnning"> Đánh giá của bạn </i>
                                    <div class="your_review">
                                        <div class="user_img">
                                            @if($user->getUsersAvata()!=null)
                                                <img src="data:image/jpeg;base64,{{$user->getUsersAvata()}}" alt="">
                                            @else
                                                <img src="{{asset('imgs/logo_website.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="user_text">
                                            <p class="name">{{$your_name}}</p>
                                            <p class="comment">{{$your_rev}}</p>
                                        </div>
                                    </div>
                                @else
                                    <form method="POST" action="{{route('putReview')}}" >
                                        @csrf
                                        <div class="input_review">
                                            <p>Your review</p>
                                            <input type="hidden"
                                            name="product_id" value="{{$product->Pid}}">
                                            <textarea name="contents" id="review" maxlength="100" required></textarea>
                                            <button type="submit" id="submitReviewBtn" class="btn btn_review">SUBMIT</button>
                                        </div>
                                    </form>
                                @endif
                            @else
                            <i class="warnning"> Cần mua sản phẩm trước khi đánh giá! </i>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
