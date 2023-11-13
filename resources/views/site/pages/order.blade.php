@extends('site.layouts.main')
@section('title', 'cart')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/cart.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/pages/order.css') }}">

@stop

@section('title-page')
<div class="title-page">
    <div class="title-page-content d-flex align-items-center justify-content-between">
        <a href="{{ route('site.cart') }}"><i class="fa-solid fa-angle-left me-3"></i>Quay lại giỏ hàng</a>
        <a>Thanh toán</a>
    </div>
</div>
@stop

@section('content')
<div class="wrapper-order" style="color:#000;background-color:transparent;">
    <div class="desc-order">
        <table class="table table-borderless align-middle">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>

                </tr>
            </thead>
            <tbody class="table-group-divider">
                @php
                use App\Helpers\NumberHelper;
                @endphp
                @foreach($listProduct as $product)
                <tr>
                    <th scope="row">
                        <img class="order-img-product" src="{{ $product->productImages->first()->link }}" alt="">
                    </th>
                    <td>{{ $product->name }}</td>
                    <td>{{ NumberHelper::format($product->price) }} đ</td>
                    <td>{{ $product->quantityCart }}</td>

                    <td>{{ NumberHelper::format($product->price*$product->quantityCart) }} đ</td>

                </tr>
                @endforeach



            </tbody>
        </table>
    </div>
    <div class="desc-info">
        <h1 class="desc-info-header text-center mb-5">Thông tin thanh toán</h1>
        <form action="{{ route('site.checkout') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3 ">
                <label for="name-user" class="form-label">Họ và tên: </label>
                <input required name="username" type="text" class="form-control" id="name-user" placeholder="Nhập họ tên...">
                <div class="invalid-feedback">
                    Nhập họ tên
                </div>
            </div>
            <div class="mb-3">
                <label for="phone-number-user" class="form-label">Số điện thoại: </label>
                <input required name="phone-number" type="tel" pattern="[0-9]{10}" class="form-control" id="phone-number-user" placeholder="Nhập số điện thoại...">
                <div class="invalid-feedback">
                    Nhập số điện thoại
                </div>
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Tỉnh thành:</label>
                <select name="province" id="province" class="form-select" required>
                    <option value="" disabled selected>---CHỌN TỈNH THÀNH---</option>
                </select>
                <div class="invalid-feedback">
                    Chọn tỉnh/thành
                </div>
            </div>
            <div class="mb-3">
                <label for="district" class="form-label">Quận huyện:</label>
                <select name="district" id="district" class="form-select" required>
                    <option value="" disabled selected>---CHỌN QUẬN HUYỆN---</option>
                </select>
                <div class="invalid-feedback">
                    Chọn Quận/Huyện
                </div>
            </div>
            <div class="mb-3">
                <label for="ward" class="form-label">Phường xã:</label>
                <select name="ward" id="ward" class="form-select" required>
                    <option value="" disabled selected>---CHỌN PHƯỜNG XÃ---</option>
                </select>
                <div class="invalid-feedback">
                    Chọn Phường/Xã
                </div>
            </div>
            <div class="mb-3">
                <label for="address-user" class="form-label">Địa chỉ: </label>
                <input type="text" name="address-user" class="form-control" id="address-user" placeholder="Nhập địa chỉ...">
            </div>
            <div class="mb-3">
                <label for="type-pay" class="form-label">Chọn phương thức thanh toán</label>
                <select name="type-pay" id="type-pay" class="form-select" required>
                    <option selected value="cod">Thanh toán khi nhận hàng</option>
                    <option value="vnpay">VNPAY</option>
                    <option value="momo">Momo</option>
                </select>
            </div>
            @foreach ($listProduct as $product)
            <input type="hidden" name="products[]" value="{{$product->id }}" />
            @endforeach
            <div class="mb-3" id="form-select-bank">

            </div>
            <button class="cofirm-order" type="submit">
                Đặt hàng
            </button>
        </form>
    </div>
</div>

@stop


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{ url('public/assets/js/address.js') }}"></script>
<script>
    renderAddress()
</script>

<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<script>
    const typepayElm = document.getElementById('type-pay');
    typepayElm.addEventListener('change', (e) => {
        const typepay = typepayElm.value;
        if (typepay === 'vnpay') {
            document.getElementById('form-select-bank').innerHTML = `<label for="type-pay" class="form-label">Chọn ngân hàng</label>
                <select name="bankcode" id="type-pay" class="form-select" required >
                    <option selected disabled value="">Chọn</option>
                    <option value="NCB">Ngan hang NCB</option>
                    <option value="VISA">VISA</option>
                    <option value="MASTERCARD">MASTERCARD</option>
                    <option value="JCB">JCB</option>
                    <option value="EXIMBANK">Ngan hang EximBank</option>
                </select>
                <div class="invalid-feedback">
                    Chọn cổng thanh toán
                </div>`;
        } else {
            document.getElementById('form-select-bank').innerHTML = '';
        }
    });
</script>
@stop