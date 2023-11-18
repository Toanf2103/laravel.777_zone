@extends('admin.layouts.main')

@section('title', 'Chi tiết bình luận - 777 Zone Admin')
@section('title-content', 'Chi tiết bình luận')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/comment/show.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.comments.index') }}">Bình luận</a></li>
<li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
@stop

@section('content')
<p class="fw-bold">Bình luận cho sản phẩm <a href="{{ route('site.product', ['productSlug' => $comment->product->slug]) }}" title="Xem sản phẩm trên trang web" target="_blank">{{ $comment->product->name }}</a></p>
<livewire:admin.comment :comment="$comment" />
@stop

@section('js')
@stop