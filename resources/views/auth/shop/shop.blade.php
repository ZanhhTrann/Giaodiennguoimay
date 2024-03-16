@php
    $pageCont=new \App\Http\Controllers\PagesController();
    $urlValues=$pageCont->__getURL($_SERVER['REQUEST_URI']);
    $urlComponents='';
    $path='';
    if(isset($_SERVER['HTTP_REFERER'])){
        $urlComponents = parse_url($_SERVER['HTTP_REFERER']);
        $path = $urlComponents['path'];
    }
    $check=false;
    if($urlValues['sort']!='Mặc định'||$urlValues['buy']!='Tất cả'||$urlValues['rent']!='Tất cả'){
        $check=true;
    }
    $previousURL = $pageCont->__getURL($path);
    // echo $previousURL;

    // dd($urlValues)
@endphp
<link rel="stylesheet" href="{{asset('css/pages/products.css')}}">
@extends('auth.layouts.app')
@section('header')
@include('auth.layouts.includes.header',['head_page'=>$urlValues['head']])
@endsection
@section('content')
<section id="section" class="section_product">
    <div class="overview_product">
        <div class="products container">
            <div class="products_menu">
                @include('auth.shop.includes.categories.categories',['value'=>$urlValues['value']])
                <div class="filter">
                    <div class="filter_item {{$check==true?'active':''}}">
                        <div class="filter_item-icon">
                            <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </div>
                        Filter
                    </div>
                </div>
                @include('auth.shop.includes.product_sort',['sort'=>$urlValues['sort'],'buy'=>$urlValues['buy'],'rent'=>$urlValues['rent']])
            </div>
            <div id="list">

            </div>
        </div>

    </div>
</section>
<script src="{{ asset('js/shop.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
    // Hàm lấy giá trị của tất cả các thẻ đang có trạng thái active
    function getActiveValues() {
        var activeValues = {};

        // Lấy giá trị của tất cả các thẻ đang có trạng thái active
        document.querySelectorAll('.sort_list-item a.active').forEach(function(activeLink) {
            var group = activeLink.classList[0]; // Sort, buy, rent
            // console.log(group);
            var value = activeLink.innerText.trim();
            activeValues[group] = value;
        });
        document.querySelectorAll('.categories li.category-item.active').forEach(function(activeLink) {
            var cid = activeLink.dataset.cid;
            var value = activeLink.innerText.trim();
            activeValues['value'] = value;
            activeValues['cid'] = cid;
        });
        // activeValues['privious'] = activeValues['value'];
        return activeValues;
    }
    // Hàm gửi dữ liệu lên server sử dụng Ajax
    function sendFormData(selectedValue) {
        // Hiển thị hiệu ứng loading
        $('#list').html('<div class="spinner"><div class="loading-spinner"></div></div>');

        $.ajax({
            url: "{{ route('sortProducts') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                value: selectedValue,
            },
            success: function (data) {
                // Ẩn hiệu ứng loading khi nhận được response
                // console.log(data);
                $('#list').html(data);
            },
            error: function () {
                // Xử lý khi có lỗi
                $('#list').html('<div class="spinner"><div class="error-message">Có lỗi xảy ra</div></div>');
            }
        });
    }
    function Load(){
        var activeValues = getActiveValues();
        var currentPage = {!! json_encode($urlValues['page']) !!};
        activeValues['page'] = currentPage;
        var currentValue = {!! json_encode($previousURL['value']) !!};

        activeValues['priValue'] = currentValue;
        console.log(activeValues,{!! json_encode(session('sort')) !!})
        sendFormData(activeValues);
    }
    Load();
    document.addEventListener('DOMContentLoaded', function () {
        // Lắng nghe sự kiện click trên các thẻ <a>
        document.querySelectorAll('.sort_list-item a').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                // Lấy giá trị từ thẻ <a> được chọn
                var selectedValue = this.innerText.trim();

                // Lấy nhóm của thẻ <a> được chọn
                var group = this.classList[0]; // Sort, buy, rent
                console.log('group Value:', group);
                // Xóa trạng thái active của tất cả các thẻ trong cùng một nhóm
                document.querySelectorAll('.' + group).forEach(function (otherLink) {
                    otherLink.classList.remove('active');
                });

                // Thêm trạng thái active vào thẻ <a> được chọn
                this.classList.add('active');

                // Lấy giá trị của tất cả các thẻ đang có trạng thái active
                var activeValues = getActiveValues();
                activeValues['page'] = '1';
                // var currentValue = activeValues['value'];
                // Gửi giá trị lên server hoặc thực hiện bất kỳ thao tác nào khác cần thiết
                $.ajax({
                    url: "{{ route('changeSort') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        value: activeValues,
                    },
                    success: function (data) {
                        $.ajax({
                            url: "{{ route('setSort') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                value: activeValues['cid'],
                            },
                            success: function (data) {

                            }
                        });
                        window.location.replace(data)
                    },
                    error: function () {
                        // Xử lý khi có lỗi
                        $('#list').html('<div class="spinner"><div class="error-message">Có lỗi xảy ra</div></div>');
                    }
                });
            });
        });
    })
    $(document).ready(function () {

        // Lắng nghe sự kiện khi một danh mục được chọn
        $('body').on('click', '.quick-view-button', function() {
            var pid = $(this).data('product-id');
            // console.log(pid);
            $.ajax({
                url: "{{ route('getQuickView') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    pid: pid
                },
                success: function (data) {
                    // console.log(data);
                    // $('#QV_detail').html('<div></div>');
                    $('#QV_detail').html(data);
                    $('#QV').addClass('active');

                }
            });
        });
        $('body').on('click', '.close_quick_view', function() {
            $('body').on('click', '.close_quick_view', function() {
                // Xóa nội dung của #QV_detail
                // Ẩn #QV
                $('#QV').removeClass('active');
            });
        });
    });
</script>
@endsection
