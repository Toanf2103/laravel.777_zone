@extends('site.layouts.main')
@section('title', $product->name)

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/product.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/slider.css') }}">

@stop

@php
use App\Helpers\NumberHelper;
@endphp
@section('content')
<div class="row test">
    <div class="col-6">
        <div class="left-page">
            <x-site.slider :listBanner="$banners" />

        </div>
    </div>
    <div class="col-6 p-2">
        <div class="right-page">
            <div>
                <h1 class="product-name">{{ $product->name }}</h1>
            </div>
            <div>
                <strong class="product-price"> {{NumberHelper::format($product->price)}} ₫ </strong>
            </div>
            <div class="mt-5">
                <table class="product-specs">
                    {!! $product->specs !!}
                </table>
            </div>
            <div class="row mt-4">
                @if($product->quantity==0)
                <div>
                    <p>Hết hàng</p>
                </div>
                @else
                <div class="col-6">
                    <livewire:site.button-add-cart :product="$product" />
                </div>
                <a href="{{ route('site.buyNow',['idProduct'=>$product->id]) }}" class="col-6">
                    <button class="action">
                        <i class="fa-regular fa-cart-shopping"></i>
                        <span>Mua ngay</span>
                    </button>
                </a>
                @endif

            </div>
        </div>
    </div>
</div>
@stop

@section('content-more')
@php
$product->description = str_replace('data-src="','src="',$product->description)
@endphp
<div class="content-more">
    <div class="content-more-wrapper">
        <div class="descr item-content-more" id="descr">
            {!! $product->description !!}

            <div class="view-more" onclick="showMoreDes()">
                <button>
                    <span>Đọc thêm</span> <i class="fa-regular fa-chevron-down"></i>
                </button>
            </div>
        </div>

        <livewire:site.product-comment :product="$product" />
    </div>
</div>


@stop

@section('js')
<script>
    function showMoreDes() {
        const descrElm = document.getElementById('descr');
        descrElm.classList.toggle('active');
    }
</script>
@stop