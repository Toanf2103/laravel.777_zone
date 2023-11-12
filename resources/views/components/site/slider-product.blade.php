@php
$id= Str::random(8);
$id = preg_replace('/[^A-Za-z]/', '', $id);
@endphp
<div id="{{ $id }}" class="carousel slide slide-product slider list-slider" data-bs-ride="true">
    <div class="carousel-inner">
        <div clas="row" style="overflow: hidden;">
            @foreach($products->chunk(4) as $index => $chunk)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="list-product-slide d-flex align-items-center active">
                    @foreach($chunk as $product)
                    <x-site.product-item :product="$product" />
                    @endforeach
                </div>
            </div>
            @endforeach
            <div class="wrapper-icon left-btn" data-bs-target="#{{$id}}" data-bs-slide="next">
                <i class="fa-light fa-arrow-left"></i>
            </div>
            <div class="wrapper-icon right-btn" data-bs-target="#{{$id}}" data-bs-slide="prev">
                <i class="fa-light fa-arrow-right"></i>
            </div>
        </div>
    </div>

</div>