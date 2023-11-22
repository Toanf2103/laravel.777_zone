@extends('site.layouts.main')
@section('title', 'Giỏ hàng')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/cart.css') }}">
@stop

@php
$checkError = false;
if(session('error')){
$checkError = session('error');
}

$checkAlert = false;
if(session('alert')){
$checkAlert = session('alert');
}
@endphp

@section('title-page')
<div class="title-page">
    <div class="title-page-content d-flex align-items-center justify-content-between">
        <a href="{{ route('site.home') }}"><i class="fa-solid fa-angle-left me-3"></i>Xem thêm sản phẩm</a>
        <a>Giỏ hàng của bạn</a>
    </div>
</div>
@stop

@section('content')

<livewire:site.cart />
@stop

@section('js')
<script>
    function showAlertWaringCart(e) {
        e.preventDefault();
        Swal.fire({
            title: "Vui lòng chọn sản phẩm",
            text: "Chưa có sản phẩm nào được chọn",
            icon: "warning"
        });
    }
</script>

@if($checkError)
<script>
    alertCustom({
        message: '{{ $checkError }}',
        type: 'error',
        duration: 1500
    })
</script>

@endif
@stop