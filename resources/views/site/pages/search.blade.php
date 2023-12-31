@extends('site.layouts.main')
@section('title', 'Tìm kiếm')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/home.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/slider.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/product_item.css') }}">

<link rel="stylesheet" href="{{ url('public/site/css/pages/catelory.css') }}">


@stop

@section('content')

<div class="row catelory-title">
    <a class="text-center">Tìm thấy {{ $listProduct->total() }} cho “{{request('key')}}”</a>
</div>





<div>
    <div>
        @if($listProduct->count()>0)
        <div class="mt-3 mb-3 d-flex align-items-center justify-content-end ft-sort" id="ft-sort">
            <div class="dropdown">
                <div id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><span class="me-3" id="text-ft-sort">Xếp theo: </span><i class="fa-light fa-chevron-down"></i></div>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="{{ request('order') == 'date' ? 'active' : '' }}" >
                        <a href="{{ request()->fullUrlWithQuery(['order' => 'date']) }}"><i class="fa-regular fa-check me-3"></i><span>Mới ra mắt</span></a>
                        
                    </li>
                    <!-- <li >
                    <i class="fa-regular fa-check me-3"></i>Bán chạy

                </li> -->
                    <li class="{{ request('order') == 'price' ? 'active' : '' }}">
                        <a href="{{ request()->fullUrlWithQuery(['order' => 'price']) }}">

                            <i class="fa-regular fa-check me-3"></i><span>Giá thấp đến cao</span>
                        </a>

                    </li>
                    <li class="{{ request('order') == 'price_desc' ? 'active' : '' }}">
                        <a href="{{ request()->fullUrlWithQuery(['order' => 'price_desc']) }}">
                            <i class="fa-regular fa-check me-3"></i><span>Giá cao đến thấp</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif


        <div class="list-product">
            @foreach($listProduct as $product)
            <x-site.product-item :product="$product" />
            @endforeach
        </div>
        <div class="mt-3 pagination-custom">

            {{ $listProduct->withQueryString()->links('site.partials.paginationCustom') }}
        </div>
    </div>


</div>

@stop

@section('js')
<script>
    const liActiveElm = document.getElementById('ft-sort').querySelector('li.active span');
    const textFtSortt = document.getElementById('text-ft-sort');
    // console.log(liActiveElm);
    textFtSortt.innerHTML = 'Xếp theo: ' + liActiveElm.innerHTML;
</script>
@stop