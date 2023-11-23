@extends('site.layouts.main')
@section('title', 'Đơn hàng của bạn')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/cart.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/pages/orderMenu.css') }}">


@stop

@section('title-page')
<div class="nav-header-order d-flex align-items-center justify-content-around">

    <a href="{{ route('site.order.menu',['type'=>'waiting']) }}" class="nav-header-items d-flex align-items-center justify-content-center {{ request('type')=='waiting'|| is_null(request()->input('type')) ? 'active' : '' }}">
        <span>
            Chờ xác nhận
        </span>
    </a>
    <a href="{{ route('site.order.menu',['type'=>'approved']) }}" class="nav-header-items d-flex align-items-center justify-content-center {{ request('type')=='approved' ? 'active' : '' }}">
        <span>
            Đã xác nhận
        </span>
    </a>
    <a href="{{ route('site.order.menu',['type'=>'shipping']) }}" class="nav-header-items d-flex align-items-center justify-content-center {{ request('type')=='shipping' ? 'active' : '' }}">
        <span>
            Đang giao
        </span>
    </a>
    <a href="{{ route('site.order.menu',['type'=>'completed']) }}" class="nav-header-items d-flex align-items-center justify-content-center {{ request('type')=='completed' ? 'active' : '' }}">
        <span>
            Hoàn thành
        </span>
    </a>

    <a href="{{ route('site.order.menu',['type'=>'cancel']) }}" class="nav-header-items d-flex align-items-center justify-content-center {{ request('type')=='cancel' ? 'active' : '' }}">
        <span>
            Đã hủy
        </span>
    </a>
</div>

@stop
@php
use App\Helpers\NumberHelper;
@endphp

@section('content')
@foreach($orders as $order)
<div class="order-wrapper">
    <div class="order-title d-flex align-items-center justify-content-between">
        <a href="{{route('site.showBillOrder',['orderId'=>$order->id])}}" target="_blank">Xem hóa đơn</a>
        <span>
            @php
            switch($order->status){
                case 'waiting':
                    echo 'Chờ xác nhận';
                    break;
                case 'approved':
                    echo 'Đã duyệt';
                    break;
                case 'shipping':
                    echo 'Đang giao';
                    break;
                case 'completed':
                    echo 'Hoàn thành';
                    break;
                case 'cancel':
                    echo 'Đã hủy';
                    break;
            }
            @endphp
        </span>
    </div>
    @foreach($order->orderDetails as $orderDetail)
    <div class="order-content d-flex align-items-center gap-5">
        <div class="order-content-img">
            <img src="{{ $orderDetail->product->productImages->get(0)->link }}" alt="">
        </div>
        <div class="order-content-info">
            <a href="{{ route('site.product',['productSlug'=>$orderDetail->product->slug]) }}" target="_blank">{{$orderDetail->product->name}}</a>
            <p>x{{$orderDetail->quantity}}</p>
        </div>
        <div class="order-contetn-price">
            <p class="price">{{ NumberHelper::format($orderDetail->price)}}đ</p>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6 row">
            <div class="col-6">
                <p>Tổng tiền: </p>
            </div>
            <div class="col-6">
                <p class="price">{{ NumberHelper::format($order->totalPrice() - $order->ship_fee) }}đ</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6 row">
            <div class="col-6">
                <p>Phí vận chuyển: </p>
            </div>
            <div class="col-6">
                <p class="price">{{ NumberHelper::format($order->ship_fee) }}đ</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6 row">
            <div class="col-6">
                <p>Tổng cộng: </p>
            </div>
            <div class="col-6">
                <p class="price">{{ NumberHelper::format($order->totalPrice()) }}đ</p>
            </div>
        </div>
    </div>
</div>
@endforeach


@stop