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
                @if(request()->is('admin'))
                <i class="fa-solid fa-grid-horizontal"></i>
                @else
                <i class="fa-light fa-grid-horizontal"></i>
                @endif
                <span>Dashboard</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/banners*')){{ 'active' }}@endif">
            <a href="{{ route('admin.banners.index') }}" class="d-flex align-items-center gap-2 ">
                @if(request()->is('admin/banners*'))
                <i class="fa-solid fa-folder"></i>
                @else
                <i class="fa-light fa-folder"></i>
                @endif
                <span>Banner</span>
            </a>
        </li>
        <li class="@if(request()->is('admin/categories*')){{ 'active' }}@endif">
            <a href="{{ route('admin.categories.index') }}" class="d-flex align-items-center gap-2 ">
                @if(request()->is('admin/categories*'))
                <i class="fa-solid fa-folder"></i>
                @else
                <i class="fa-light fa-folder"></i>
                @endif
                <span>Danh mục</span>
            </a>
        </li>
    </ul>
</aside>