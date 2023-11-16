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
                @auth('user')
                <img src="{{ auth()->guard('user')->user()->avatar ?? 'https://storage.googleapis.com/laravel-img.appspot.com/user/customer-default.png' }}" alt="" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">{{ auth()->guard('user')->user()->full_name }}</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="{{route('site.auth.logout')}}">logout</a></li>
                </ul>
                
                @else
                <a data-bs-toggle="modal" data-bs-target="#login-model">Đăng nhập</a>
                @endauth
            </div>

        </div>

        <livewire:site.header-search />

    </div>
</header>
<div class="bg-overlay none" id="bg-overlay">

</div>
@unless(auth('user')->check())
<div class="modal fade" id="login-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login">

            <livewire:site.login />

        </div>
    </div>
</div>
@endunless
