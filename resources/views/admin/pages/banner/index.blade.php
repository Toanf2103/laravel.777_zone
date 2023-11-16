@extends('admin.layouts.main')

@section('title', 'Danh sách banner - 777 Zone Admin')
@section('title-content', 'Danh sách banner')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/banner/index.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Banner</li>
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <div>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-success d-flex justify-content-center align-items-center gap-2 ms-auto" style="width: fit-content;">
            <i class="fa-solid fa-plus"></i>
            <span>Thêm mới</span>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Hình ảnh</th>
                    <th>Nơi hiển thị</th>
                    <th>Link đến</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr data-url="{{ route('admin.banners.edit', ['banner' => $banner->id]) }}">
                    <th>{{ $banner->id }}</th>
                    <td>
                        <img src="{{ $banner->image ?? '' }}" alt="" class="banner-image">
                    </td>
                    <td>
                        {{ $banner->category_id ? "Danh mục / ".$banner->category->name : 'Trang chủ' }}
                    </td>
                    <td>
                        {{ $banner->link ? $banner->link : 'Trang hiện tại'}}
                    </td>
                    <td>
                        @if($banner->status)
                        <span class='badge bg-success'>Hiển thị</span>
                        @else
                        <span class='badge bg-secondary'>Ẩn</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $banners->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@stop

@section('js')
<script>
    const listTr = document.querySelectorAll('table tr[data-url]')
    listTr.forEach((tr) => {
        tr.onclick = () => {
            location.href = tr.dataset.url
        }
    })
</script>
@stop