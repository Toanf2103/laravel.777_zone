@php
use App\Helpers\NumberHelper
@endphp
<form action="{{ route('site.order') }}" method="GET" id="cart-cpn">
    <div class="cart-wrapper-page">
        <div class="cart-page-header d-flex align-items-center justify-content-between gap-3">
            <div class="cart-header-choose d-flex align-items-center">
                <input type="checkbox" wire:click="checkAllF" wire:model="checkAll">
            </div>
            <span class="cart-header-all d-flex align-items-center">Chọn tất cả</span>
            <div class="cart-header-action" id="delete-confirm" data-confirm="{{ count($checkList) }}">
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
                    <input type="checkbox" wire:model.live="checkList" value="{{ $cartItem['id'] }}" name="prod[]">
                </div>
                <div class="cart-info-product d-flex align-items-center me-5">
                    <img class="cart-info-img" src="{{ $cartItem['product']->productImages->get(0)->link }}" alt="">
                    <a href="{{ route('site.product',['productSlug'=>$cartItem['product']->slug]) }}" class="cart-info-name">
                        {{ $cartItem['product']->name }}
                    </a>
                    <div class="cart-info-price d-flex align-items-center gap-5">
                        <p class="text-price">{{NumberHelper::format($cartItem['product']->price*$cartItem['quantity'])}} ₫</p>
                        <p type="button" class="delete-confirm" data-confirm="{{ $cartItem['id'] }}">
                            <i class="fa-light fa-trash-can me-3"></i>
                        </p>
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
                <button @if(count($checkList)>0) type="submit" @else onclick="showAlertWaringCart(event)" @endif>
                    Đặt hàng
                </button>
            </div>
        </div>
    </div>
    <script>
       
    
    document.addEventListener('livewire:initialized', function(e) {
        
        component = window.Livewire.find(document.getElementById('cart-cpn').getAttribute('wire:id'));

        const btnCofirmDeleteAll = document.getElementById('delete-confirm');
        btnCofirmDeleteAll.addEventListener('click', (e) => {
            if (btnCofirmDeleteAll.getAttribute('data-confirm') > 0) {
                Swal.fire({
                    title: "Xác nhận xóa?",
                    text: "Bạn có muốn xóa các sản phẩm được chọn ra khỏi giỏ hàng",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Xác nhận",
                    cancelButtonText: "Hủy"

                }).then((result) => {
                    if (result.isConfirmed) {
                        component.deleteListProduct();
                        Swal.fire({
                            title: "Xóa thành công!",
                            text: "Bạn đã xóa thành công sản phẩm ra khỏi giỏ hàng.",
                            icon: "success"
                        });

                    }
                });
            }

        });

        const deleteProducts = document.querySelectorAll('.delete-confirm')

        deleteProducts.forEach(function(element) {
            element.addEventListener('click', (e) => {

                Swal.fire({
                    title: "Xác nhận xóa?",
                    text: "Bạn có muốn xóa sản phẩm ra khỏi giỏ hàng",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Xác nhận",
                    cancelButtonText: "Hủy"

                }).then((result) => {
                    if (result.isConfirmed) {
                        const idProd = element.getAttribute('data-confirm');
                        component.deleteProduct(idProd);
                        Swal.fire({
                            title: "Xóa thành công!",
                            text: "Bạn đã xóa thành công sản phẩm ra khỏi giỏ hàng.",
                            icon: "success"
                        });

                    }
                });


            })
        });

    });
    </script>;
    

</form>