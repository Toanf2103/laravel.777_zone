@extends('site.layouts.main')
@section('title', 'product')

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
            <x-site.slider :listBanner="$banners"/>

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
                <div class="col-6">
                    <livewire:site.button-add-cart :product="$product" />
                </div>
                <div class="col-6">
                    <button class="action">
                        <i class="fa-regular fa-cart-shopping"></i>
                        <span>Mua ngay</span>
                    </button>
                </div>
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
        <div class="comment-product-wrapper item-content-more">
            <h2>Đánh giá sản phẩm</h2>
            <div class="comment-product-content">
                <div>
                    <div class="comment-item d-flex align-items-start justify-content-start gap-3">
                        <div class="avatar">
                            <img src="https://scontent.fdad3-1.fna.fbcdn.net/v/t39.30808-1/292048785_3156970211231523_8971168664703602711_n.jpg?stp=cp0_dst-jpg_p60x60&_nc_cat=110&ccb=1-7&_nc_sid=5f2048&_nc_ohc=LkjQxjDVGikAX-T6BxH&_nc_ht=scontent.fdad3-1.fna&oh=00_AfCWkVOOt-EGqkvLYZiGAtoFq9A2N5FEsPv-Xb3EUnBsHg&oe=65525A37" alt="">
                        </div>
                        <div class="comment-item-content">
                            <div class="comment-name">
                                <p>Phạm Trưởng</p>

                            </div>
                            <div class="comment-content">
                                <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam rem inventore voluptatibus rerum, corrupti saepe non vitae, magni quaerat illo consequatur deleniti quae excepturi ex possimus cumque et? Ducimus, ea!</span>
                            </div>
                            <div class="comment-time d-flex align-items-center justify-content-start gap-3">
                                <span>1 ngày trước</span>
                                <i class="fa-duotone fa-circle"></i>
                                <p>Trả lời</p>
                            </div>
                        </div>
                    </div>

                    <div class="comment-item d-flex align-items-start justify-content-start gap-3 comment-replay mt-4">
                        <div class="avatar">
                            <img src="https://scontent.fdad3-1.fna.fbcdn.net/v/t39.30808-1/292048785_3156970211231523_8971168664703602711_n.jpg?stp=cp0_dst-jpg_p60x60&_nc_cat=110&ccb=1-7&_nc_sid=5f2048&_nc_ohc=LkjQxjDVGikAX-T6BxH&_nc_ht=scontent.fdad3-1.fna&oh=00_AfCWkVOOt-EGqkvLYZiGAtoFq9A2N5FEsPv-Xb3EUnBsHg&oe=65525A37" alt="">
                        </div>
                        <div class="comment-item-content">
                            <div class="comment-name">
                                <p>Phạm Trưởng</p>

                            </div>
                            <div class="comment-content">
                                <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam rem inventore voluptatibus rerum, corrupti saepe non vitae, magni quaerat illo consequatur deleniti quae excepturi ex possimus cumque et? Ducimus, ea!</span>
                            </div>
                            <div class="comment-time d-flex align-items-center justify-content-start gap-3">
                                <span>1 ngày trước</span>
                                <i class="fa-duotone fa-circle"></i>
                                <p>Trả lời</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-comment send-replay">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit">Gửi bình luận</button>
                        </div>
                    </div>
                </div>
            </div>

            <p class="title-comment">Viết bình luận</p>
            <div class="form-comment">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit">Gửi bình luận</button>
                </div>
            </div>
        </div>


    </div>

</div>


@stop

@section('js')
<script>
    function showMoreDes() {
        const descrElm = document.getElementById('descr');
        descrElm.classList.toggle('active');
    }

    // Show alert add product to cart
    window.addEventListener('alertProductToCart', (e) => {
        data = e.detail[0];
        // console.log(data);
        Swal.fire({
            title: `Thêm thành công`,
            text: `Thêm sản phẩm ${data.productAdd} vào giỏ hàng thành công!`,
            icon: "success"
        });
        cartHeaderElm = document.getElementById('cart-header');
        if(data.count>0){
            cartHeaderElm.innerHTML = `<span>${data.count}</span>`;
        }else{
            cartHeaderElm.innerHTML = "";
        }
    })
</script>
@stop