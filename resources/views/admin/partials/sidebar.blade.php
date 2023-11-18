<aside>
    <a href="{{ route('admin.dashboard') }}" class="logo-aside">
        <h2>777 ZONE ADMIN</h2>
    </a>
    <ul class="d-flex flex-column mt-3 gap-1">
        <li class="mb-3 pb-3 user-panel @if(request()->is('admin/personal*')){{ 'active' }}@endif">
            <a href="{{ route('admin.auth.personal') }}" class="d-flex align-items-center gap-2">
                @php
                $user = auth()->guard('admin')->user()
                @endphp
                <img class="avatar-radius" src="{{ $user->avatar }}" alt="">
                <span>{{ $user->full_name }}</span>
            </a>
        </li>
        <li class="@if(request()->is('admin')){{ 'active' }}@endif">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
                <div class="icon-box">
                    @if(request()->is('admin'))
                    <i class="fa-solid fa-gauge-max"></i>
                    @else
                    <i class="fa-light fa-gauge-max"></i>
                    @endif
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/banners*')){{ 'active' }}@endif">
            <a href="{{ route('admin.banners.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/banners*'))
                    <i class="fa-sharp fa-solid fa-images"></i>
                    @else
                    <i class="fa-sharp fa-light fa-images"></i>
                    @endif
                </div>
                <span>Banner</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/categories*')){{ 'active' }}@endif">
            <a href="{{ route('admin.categories.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/categories*'))
                    <i class="fa-solid fa-list"></i>
                    @else
                    <i class="fa-light fa-list"></i>
                    @endif
                </div>
                <span>Danh mục</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/brands*')){{ 'active' }}@endif">
            <a href="{{ route('admin.brands.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/brands*'))
                    <i class="fa-sharp fa-solid fa-tags"></i>
                    @else
                    <i class="fa-sharp fa-light fa-tags"></i>
                    @endif
                </div>
                <span>Thương hiệu</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/products*')){{ 'active' }}@endif">
            <a href="{{ route('admin.products.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/products*'))
                    <i class="fa-sharp fa-solid fa-laptop-mobile"></i>
                    @else
                    <i class="fa-sharp fa-light fa-laptop-mobile"></i>
                    @endif
                </div>
                <span>Sản phẩm</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/customers*')){{ 'active' }}@endif">
            <a href="{{ route('admin.customers.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/customers*'))
                    <i class="fa-solid fa-users"></i>
                    @else
                    <i class="fa-light fa-users"></i>
                    @endif
                </div>
                <span>Khách hàng</span>
            </a>
        </li>
        <li class="">
            <a href="#" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    <!-- <i class="fa-sharp fa-solid fa-clipboard-list-check"></i> -->
                    <i class="fa-sharp fa-light fa-clipboard-list-check"></i>
                </div>
                <span>Đơn hàng</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/comments*')){{ 'active' }}@endif">
            <a href="{{ route('admin.comments.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/comments*'))
                    <i class="fa-sharp fa-solid fa-message-lines"></i>
                    @else
                    <i class="fa-sharp fa-light fa-message-lines"></i>
                    @endif
                </div>
                <span>Bình luận</span>
            </a>
        </li>
        @if(auth()->guard('admin')->user()->role == 'admin')
        <li class="@if(request()->is('admin/employees*')){{ 'active' }}@endif">
            <a href="{{ route('admin.employees.index') }}" class="d-flex align-items-center gap-2 ">
                <div class="icon-box">
                    @if(request()->is('admin/employees*'))
                    <i class="fa-sharp fa-solid fa-id-card"></i>
                    @else
                    <i class="fa-sharp fa-light fa-id-card"></i>
                    @endif
                </div>
                <span>Nhân viên</span>
            </a>
        </li>
        @endif
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