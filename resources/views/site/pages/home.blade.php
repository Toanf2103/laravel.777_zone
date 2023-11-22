@extends('site.layouts.main')
@section('title', 'Trang chủ')
@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/home.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/slider.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/product_item.css') }}">


@stop

@section('slider')
<div style="overflow: hidden;">
    <x-site.slider :listBanner="$banners"/>
</div>
@stop

@section('content')

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