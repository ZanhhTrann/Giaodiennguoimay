<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_features.css')}}">
<link rel="stylesheet" href="{{asset('css/pages/products.css')}}">
@extends('auth.layouts.app')
@section('header')
@include('auth.layouts.includes.header',['head_page'=>'orders'])
@endsection
@section('content')

    <script src="{{asset('js/features.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
    @include('auth.pay.includes.pay');
@endsection
