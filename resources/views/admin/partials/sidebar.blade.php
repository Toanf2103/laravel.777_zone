<aside>
    <a href="#" class="logo-aside">
        <h2>777 ZONE ADMIN</h2>
    </a>
    <ul class="d-flex flex-column mt-3 gap-1">
        <li class="mb-3 pb-3 user-panel">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
                <img class="avatar-radius" src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" alt="">
                <span>Nguyễn Admin</span>
            </a>
        </li>
        <li class="@if(request()->is('admin')){{ 'active' }}@endif">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
                <div class="icon-box">
                    @if(request()->is('admin'))
                    <i class="fa-solid fa-grid-horizontal"></i>
                    @else
                    <i class="fa-light fa-grid-horizontal"></i>
                    @endif
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/banners*')){{ 'active' }}@endif">
            <a href="{{ route('admin.banners.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/banners*'))
                    <i class="fa-solid fa-folder"></i>
                    @else
                    <i class="fa-light fa-folder"></i>
                    @endif
                </div>
                <span>Banner</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/categories*')){{ 'active' }}@endif">
            <a href="{{ route('admin.categories.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/categories*'))
                    <i class="fa-solid fa-folder"></i>
                    @else
                    <i class="fa-light fa-folder"></i>
                    @endif
                </div>
                <span>Danh mục</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/products*')){{ 'active' }}@endif">
            <a href="{{ route('admin.products.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/products*'))
                    <i class="fa-solid fa-mobile"></i>
                    @else
                    <i class="fa-light fa-mobile"></i>
                    @endif
                </div>
                <span>Sản phẩm</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2" href="{{ route('admin.auth.logout') }}">
                <div class="icon-box">
                    <i class="fa-light fa-right-from-bracket"></i>
                </div>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</aside>