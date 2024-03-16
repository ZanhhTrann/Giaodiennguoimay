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
    @include('auth.bill.includes.main_content',['product'=>$product,'Oid'=>$Oid,'detail'=>$detail])
</section>
<script src="{{ asset('js/home.js') }}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{ asset('js/product-detail.js') }}"></script>
@endsection
