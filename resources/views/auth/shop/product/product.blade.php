@php
    $currentURL = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $currentURL);
    // Lọc bỏ các phần tử trống (do dấu '/' liền nhau)
    $parts = array_filter($parts);
    // Lấy giá trị từng phần tử
    $head = isset($parts[1]) ? $parts[1] : null; // "/shop"/
    // dd($currentURL,$head,$value,$page);
@endphp
<link rel="stylesheet" href="{{asset('css/pages/products-detail.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/pages/products.css')}}"> --}}
@extends('auth.layouts.app')
@section('header')
@include('auth.layouts.includes.header',['head_page'=>$head])
@endsection
@section('content')
<section id="section" class="section_product-details">
    @include('auth.shop.product.includes.main_content',['product'=>$product])
    @include('auth.shop.product.includes.tab_content',['product'=>$product])
</section>
<script src="{{ asset('js/home.js') }}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{ asset('js/product-detail.js') }}"></script>
{{-- <script>
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
</script> --}}
@endsection
