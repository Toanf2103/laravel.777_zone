@extends('site.layouts.main')
@section('title', 'Trang chủ')
@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/home.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/slider.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/product_item.css') }}">


@stop

@section('slider')
<div style="overflow: hidden;">
    <x-site.slider />
</div>
@stop

@section('content')
<!-- <div class="row">
    <a href="#" class="col-2 item-category me-5">
        <div class="row d-flex algin-items-center justify-content-center">
            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/mwgcart/topzone/images/desktop/Mac_Desktop.png" alt="">
        </div>
        <div class="row d-flex algin-items-center justify-content-center mt-1 mb-4">
            <p class="text-center">Iphone</p>
        </div>
    </a>
    <a href="#" class="col-2 item-category me-5">
        <div class="row d-flex algin-items-center justify-content-center">
            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/mwgcart/topzone/images/desktop/Mac_Desktop.png" alt="">
        </div>
        <div class="row d-flex algin-items-center justify-content-center mt-1 mb-4">
            <p class="text-center">Iphone</p>
        </div>
    </a>
    <a href="#" class="col-2 item-category me-5">
        <div class="row d-flex algin-items-center justify-content-center">
            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/mwgcart/topzone/images/desktop/Mac_Desktop.png" alt="">
        </div>
        <div class="row d-flex algin-items-center justify-content-center mt-1 mb-4">
            <p class="text-center">Iphone</p>
        </div>
    </a>
</div> -->

@foreach($listCategories as $category)
<div class="row catelory-title">
    <a href=" {{route('site.category',['categorySlug'=>$category->slug])}} " class="text-center">{{ $category->name }}</a>
</div>

<x-site.slider-product :category="$category"/>

@endforeach



@stop

@section('js')
<script src="{{ url('public/site/js/slider.js') }}"></script>
@stop