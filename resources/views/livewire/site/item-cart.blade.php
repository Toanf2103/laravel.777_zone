@php
use App\Helpers\NumberHelper
@endphp
<div class="d-flex align-items-center justify-content-between gap-3">
    <div class="cart-header-choose d-flex align-items-center">
        <input type="checkbox">
    </div>
    <div class="cart-info-product d-flex align-items-center me-5">
        <img class="cart-info-img" src="https://fptshop.com.vn/Uploads/Originals/2023/9/16/638304536466753948_iphone-15-plus-den-1.jpg" alt="">
        <p class="cart-info-name">
            {{ $prod->name }}
        </p>
        <div class="cart-info-price d-flex align-items-center gap-5">
            <p class="text-price">{{NumberHelper::format($prod->price*$quantity)}} ₫</p>       
            <p><i class="fa-light fa-trash-can me-3"></i></p>
        </div>

    </div>
    <div class="cart-count-product">
        <span wire:click="incrementQuantity">-</span>
        <input class="active" type="number" value="{{ $quantity }}">
        <span wire:click="decrementQuantity">+</span>
    </div>
</div>