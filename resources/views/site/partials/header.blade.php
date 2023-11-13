<header>
    <div class="head d-flex align-items-center justify-content-center">
        <div class="header-logo">
            <a href="{{route('site.home')}}">
                <img src="https://cdn.discordapp.com/attachments/872448203583262763/1173244319432454325/777zone_logo.png" alt="">
            </a>
        </div>
        <ul class="header-menu d-flex align-items-center justify-content-start">

            @foreach($listCategories as $category)

            <li class=' {{ request()->is("category/{$category->slug}*") ? "active" :"" }} '>
                <a href="{{ route('site.category',['categorySlug'=>$category->slug]) }}">{{ $category->name }}</a>
            </li>
            @endforeach


        </ul>
        <div class="d-flex align-items-center gap-3 header-search_cart justify-content-center ">
            <div class="wrapper-icon" onclick="showSearchForm()">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
            </div>
            @php
            use Illuminate\Support\Facades\Session;

            $cart = Session::get('cart') ?? [];
            $count= count($cart);
            @endphp
            <!-- cart -->
            <a href="{{ route('site.cart') }}" class="wrapper-icon cart-header">
                <i class="fa-sharp fa-solid fa-cart-shopping"></i>
                <div id="cart-header">
                    @if($count>0)
                    <span>{{$count}}</span>
                    @endif
                </div>

            </a>
            <!-- end cart -->

            <div class="login dropdown">
                <!-- <a href="#">Đăng nhập</a> -->
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRF7TvgBaM6ZAsPwj9vSPIYbrgptnGsQTKOTx92T_R1hdjIMwbwchEExCIdxVAdCAAVi74&usqp=CAU" alt="" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>

        </div>

        <livewire:site.header-search />

    </div>
</header>
<div class="bg-overlay none" id="bg-overlay">

</div>