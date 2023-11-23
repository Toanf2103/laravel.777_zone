@php
use App\Helpers\NumberHelper;
@endphp
<a href="{{ route('site.product',['productSlug'=>$product->slug]) }}" class="product-item d-flex flex-column">
    @if(count($product->productImages)==0)
    <img src="https://fptshop.com.vn/Uploads/Originals/2023/9/9/638298600173027154_dell-inspiron-15-n3530-bac-1.jpg" alt="">
    @else
    <img src="{{ $product->productImages->get(0)->link }} " alt="">
    @endif
    <h3 class="prodcut-item-name mt-5 mb-3">{{ $product->name }}</h3>
    <div class="d-flex align-items-end justify-content-center" style="flex:1;">
        <span class="prodcut-item-price mb-3">
            {{NumberHelper::format($product->price)}} ₫
        </span>
    </div>
</a>