@extends('site.layouts.main')
@section('title', 'Tra cứu đơn hàng')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/cart.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/pages/orderMenu.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/pages/searchOrder.css') }}">



@stop

@section('title-page')
<div class="title-page">
    <div class="title-page-content d-flex align-items-center justify-content-between">
        <a href="{{ route('site.home') }}"><i class="fa-solid fa-angle-left me-3"></i>Quay lại trang chủ</a>
        <a>Tra cứu đơn hàng</a>
    </div>
</div>

@stop
@php
use App\Helpers\NumberHelper;
@endphp

@section('content')
<form action="{{route('site.search.order')}}" method="GET">
    <div class="input-group mb-3">
        <input value="{{ request()->get('id_order') }}" type="text" class="form-control" name="id_order" required placeholder="Nhập mã đơn hàng" aria-label="Nhập mã đơn hàng" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-regular fa-magnifying-glass"></i></button>
    </div>
    @if(request()->has('id_order'))
    <div class="result-search order-wrapper">
        @if($order === null)
        <p class="no-results">
            Không có đơn hàng nào được tìm thấy
        </p>
        @else
        <div class="order-title  d-flex align-items-center justify-content-between">
            <a href="{{route('site.showBillOrder',['orderId'=>$order->id])}}" target="_blank">Xem hóa đơn</a>
            <span>
            @php
            switch($order->status){
                case 'creating':
                    echo 'Thanh toán không thành công';
                    break;
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
        @endif
    </div>
    @endif


</form>


@stop