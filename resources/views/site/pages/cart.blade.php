@extends('site.layouts.main')
@section('title', 'cart')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/cart.css') }}">
@stop

@section('title-page')
<div class="title-page">
    <div class="title-page-content d-flex align-items-center justify-content-between">
        <a href="#"><i class="fa-solid fa-angle-left me-3"></i>Xem thêm sản phẩm</a>
        <a>Giỏ hàng của bạn</a>
    </div>
</div>
@stop

@section('content')
<livewire:site.cart />
@stop


@section('js')
<script>
   

    // Show alert add product to cart
    window.addEventListener('alertDeleteProductToCart', (e) => {
        data = e.detail[0];
        // console.log(data);
        Swal.fire({
            title: `Xóa thành công`,
            text: `Xóa thành công sản phẩm ra khỏi giỏ hàng`,
            icon: "info"
        });
        cartHeaderElm = document.getElementById('cart-header');
        if (data.count > 0) {
            cartHeaderElm.innerHTML = `<span>${data.count}</span>`;
        } else {
            cartHeaderElm.innerHTML = "";
        }
    })
</script>
@stop