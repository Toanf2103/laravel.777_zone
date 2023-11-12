@php
use App\Helpers\NumberHelper
@endphp
<div class="cart-wrapper-page">
    <div class="cart-page-header d-flex align-items-center justify-content-between gap-3">
        <div class="cart-header-choose d-flex align-items-center"  >
            <input type="checkbox" wire:click="checkAllF" wire:model="checkAll">
        </div>
        <span class="cart-header-all d-flex align-items-center">Chọn tất cả</span>
        <div class="cart-header-action" wire:click="deleteListProduct">
            <span><i class="fa-light fa-trash-can me-3"></i>Xóa</span>
        </div>
    </div>
    <div class="cart-page-content d-flex flex-column gap-5">
        @if(!count($cart)>0)
        <p class="no-product mt-5 p-5 text-center">
            Không có sản phẩm trong giỏ hàng!
        </p>
        @else
        @foreach($cart as $cartItem)

        <div class="d-flex align-items-center justify-content-between gap-3">
            <div class="cart-header-choose d-flex align-items-center">
                <input type="checkbox" wire:model.live="checkList" value="{{ $cartItem['id'] }}">
            </div>
            <div class="cart-info-product d-flex align-items-center me-5">
                <img class="cart-info-img" src="https://fptshop.com.vn/Uploads/Originals/2023/9/16/638304536466753948_iphone-15-plus-den-1.jpg" alt="">
                <p class="cart-info-name">
                    {{ $cartItem['product']->name }}
                </p>
                <div class="cart-info-price d-flex align-items-center gap-5">
                    <p class="text-price">{{NumberHelper::format($cartItem['product']->price*$cartItem['quantity'])}} ₫</p>
                    <p wire:click="deleteProduct({{ $cartItem['id'] }})"><i class="fa-light fa-trash-can me-3"></i></p>
                </div>

            </div>
            <div class="cart-count-product">
                <span wire:click="decrementQuantity({{$cartItem['id']}})">-</span>
                <input class="active" type="number" value="{{ $cartItem['quantity'] }}">
                <span wire:click="incrementQuantity({{$cartItem['id']}})">+</span>
            </div>
        </div>

        @endforeach
        @endif
    </div>
    <div class="cart-page-footer">
        <div class="d-flex align-items-center justify-content-between">
            <p>Tổng tiền:</p>
            <p class="text-price">{{ NumberHelper::format($total) }}₫</p>
        </div>
        <div class="d-flex align-items-center justify-content-end action mt-5">
            <button>
                Đặt hàng
            </button>
        </div>
    </div>
</div>