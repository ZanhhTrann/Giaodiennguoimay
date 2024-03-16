@php
    $pageCont=new \App\Http\Controllers\PagesController();
    $urlValues=$pageCont->__getURL($_SERVER['REQUEST_URI']);
    // echo $previousURL;
    // dd($urlValues)
@endphp
<link rel="stylesheet" href="{{asset('css/pages/contract.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_contract.css')}}">
@extends('auth.layouts.app')
@section('header')
@include('auth.layouts.includes.header',['head_page'=>$urlValues['head']])
@endsection
@section('content')
<div class="section_contract">
    <div class="img_content">Liên hệ</div>
    <div class="container">
        @include('auth.contact.includes.sending')
        @include('auth.contact.includes.contact_infor')
    </div>
    @include('auth.contact.includes.map')
</div>
<script src="{{asset('js/home.js')}}"></script>
@endsection
