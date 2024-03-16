
@php
    $pageCont=new \App\Http\Controllers\PagesController();
    $urlValues=$pageCont->__getURL($_SERVER['REQUEST_URI']);
    if(session('login')){
        $user=new \App\Http\Controllers\UsersController();
        $cart=$user->getCart();
    }
    // echo $previousURL;
    // dd($urlValues)
@endphp
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_features.css')}}">
@extends('auth.layouts.app')
@section('header')
@include('auth.layouts.includes.header',['head_page'=>$urlValues['head']])
@endsection
@section('content')
    <div id="section" class="section_features">
        <div class="container_reatures">
            @if(session('login')&&count($cart)>0)
                <div class="reatures">
                    @include('auth.custom.includes.cart_detail')
                    {{-- @include('auth.custom.includes.cart_total') --}}
                </div>
            @else
                @include('auth.custom.includes.cart_empty')
            @endif
        </div>
    </div>
    <script src="{{asset('js/features.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
