@extends('site.layouts.main')
@section('title', 'cart')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/showBillOrder.css') }}">


@stop
@php


$checkAlert = false;
if(session('alert')){
$checkAlert = session('alert');
}
@endphp


@section('content')


<div class="title-page">
    <div class="title-page-content d-flex align-items-center justify-content-between">
        <a href="{{ route('site.cart') }}"><i class="fa-solid fa-angle-left me-3"></i>Quay lại giỏ hàng</a>
        <a target="_blank" href="{{ route('site.pdfOrder',['orderId'=>$order->id]) }}">Tải xuống PDF</a>
    </div>
</div>


@include('site.partials.billPdf')

@stop

@section('js')
@if($checkAlert)
<script>
    alertCustom({
        message: '{{ $checkAlert }}',
        type: 'success',
        duration: 1500
    })
</script>

@endif
@stop