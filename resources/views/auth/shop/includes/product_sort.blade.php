@php
    if($sort!='Mặc định'||$buy!='Tất cả'||$rent!='Tất cả'){
        $check=true;
    }
@endphp
<form id="filterForm" action="{{ route('sortProducts') }}" method="POST">
    @csrf
    <div class="products_sort {{$check==true?'active':''}}">
        <div class="row">
            <div class="col sort_by">
                <div class="text">Sắp xếp theo</div>
                <ul class="sort_list">
                    <li class="sort_list-item default">
                        <a class="sort {{$sort=='Mặc định'? 'active':''}}">Mặc định</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="sort {{$sort=='Phổ biến'? 'active':''}}" >Phổ biến</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="sort {{$sort=='Độ đánh giá'? 'active':''}}" >Độ đánh giá</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="sort {{$sort=='Đồ mới'? 'active':''}}" >Đồ mới</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="sort {{$sort=='Giá: Thấp đến cao'? 'active':''}}" >Giá: Thấp đến cao</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="sort {{$sort=='Giá: Cao đến thấp'? 'active':''}}" >Giá: Cao đến thấp</a>
                    </li>
                </ul>
            </div>

            <div class="col price">
                <div class="text">Giá mua</div>
                <ul class="sort_list">
                    <li class="sort_list-item default">
                        <a class="buy {{$buy=='Tất cả'? 'active':''}}">Tất cả</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="buy {{$buy=='Dưới 15tr VND'? 'active':''}}">Dưới 15tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="buy {{$buy=='15tr - 17tr VND'? 'active':''}}">15tr - 17tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="buy {{$buy=='17tr - 20tr VND'? 'active':''}}">17tr - 20tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="buy {{$buy=='20tr - 25tr VND'? 'active':''}}">20tr - 25tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="buy {{$buy=='Trên 25tr VND'? 'active':''}}">Trên 25tr VND</a>
                    </li>
                </ul>
            </div>

            <div class="col color">
                <div class="text">Giá thuê</div>
                <ul class="sort_list">
                    <li class="sort_list-item default">
                        <a class="rent {{$rent=='Tất cả'? 'active':''}}" href="">Tất cả</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="rent {{$rent=='Dưới 1.5tr VND'? 'active':''}}" href="">Dưới 1.5tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="rent {{$rent=='1.5tr - 2.0tr VND'? 'active':''}}" href="">1.5tr - 2.0tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="rent {{$rent=='2.0tr - 2.5tr VND'? 'active':''}}" href="">2.0tr - 2.5tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="rent {{$rent=='2.5tr -3tr VND'? 'active':''}}" href="">2.5tr -3tr VND</a>
                    </li>
                    <li class="sort_list-item">
                        <a class="rent {{$rent=='Trên 3tr VND'? 'active':''}}" href="">Trên 3tr VND</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</form>
