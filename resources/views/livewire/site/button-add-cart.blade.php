<button class="action" wire:click="addToCart">
    <i class="fa-regular fa-cart-shopping"></i>
    <span>Thêm vào giỏ hàng</span>
</button>
<script>
    

    // Show alert add product to cart
    window.addEventListener('alertProductToCart', (e) => {
        data = e.detail[0];
        Swal.fire({
            title: `Thêm thành công`,
            text: `Thêm sản phẩm ${data.productAdd} vào giỏ hàng thành công!`,
            icon: "success"
        });
        cartHeaderElm = document.getElementById('cart-header');
        if (data.count > 0) {
            cartHeaderElm.innerHTML = `<span>${data.count}</span>`;
        } else {
            cartHeaderElm.innerHTML = "";
        }
    })
</script>