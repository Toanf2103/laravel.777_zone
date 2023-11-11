@extends('admin.layouts.main')

@section('title', 'Danh sách thương hiệu - 777 Zone Admin')
@section('title-content', 'Danh sách thương hiệu')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/brand/index.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Thương hiệu</li>
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <div>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-success d-flex justify-content-center align-items-center gap-2 ms-auto" style="width: fit-content;">
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
                    <th>Tên thương hiệu</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr data-url="{{ route('admin.brands.edit', ['brand' => $brand->id]) }}">
                    <th>{{ $brand->id }}</th>
                    <td>
                        <img src="{{ $brand->avatar }}" alt="" class="brand-image">
                    </td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->products->count() }}</td>
                    <td>
                        @if($brand->status)
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

    {{ $brands->withQueryString()->links('pagination::bootstrap-5') }}
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