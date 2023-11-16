@php
use App\Helpers\NumberHelper;
@endphp

@extends('admin.layouts.main')

@section('title', 'Danh sách sản phẩm - 777 Zone Admin')
@section('title-content', 'Danh sách sản phẩm')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/product/index.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
@stop

@section('content')

<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success d-flex justify-content-center align-items-center gap-2 ms-auto" style="width: fit-content;">
            <i class="fa-solid fa-plus"></i>
            <span>Thêm mới</span>
        </a>
    </div>

    <form>
        <div class="d-flex flex-wrap justify-content-start algin-items-center gap-2 gap-md-3">
            <div class="col-12 col-md-auto">
                <input class="form-control" type="text" name="key" autocomplete="off" placeholder="Nhập từ khóa tìm kiếm..." value="{{ request()->input('key') }}">
            </div>
            <div class="col-12 col-md-auto">
                <select name="category" class="form-select">
                    <option value="">Danh mục</option>
                    @foreach($listCategories as $category)
                    <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <select name="brand" class="form-select">
                    <option value="">Thương hiệu</option>
                    @foreach($listBrands as $brand)
                    <option value="{{ $brand->id }}" {{ request()->input('brand') == $brand->id ? 'selected' : ''  }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <select name="status" class="form-select">
                    <option value="">Chế độ hiển thị</option>
                    <option value="1" {{ request()->input('status') === '1' ? 'selected' : ''  }}>Công khai</option>
                    <option value="0" {{ request()->input('status') === '0' ? 'selected' : ''  }}>Riêng tư</option>
                </select>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Tìm kiếm</span>
                </button>
            </div>
            <div class="col-md-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-info gap-2">
                    <i class="fa-solid fa-rotate"></i>
                    <span>Làm mới</span>
                </a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        @if($products->count() ==0)
        <table class="table align-middle m-0">
            <tr>
                <td>
                    <h4>Danh sách sản phẩm trống</h4>
                </td>
            </tr>
        </table>
        @else
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr data-url="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                    <th>{{ $product->id }}</th>
                    <td>
                        <img src="{{ $product->productImages->get(0)->link ?? '' }}" alt="" class="product-image">
                    </td>
                    <td class="product-name">{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->brand->name }}</td>
                    <td>{{ NumberHelper::format($product->price) }} đ</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        @if($product->status)
                        <span class='badge bg-success'>Hiển thị</span>
                        @else
                        <span class='badge bg-secondary'>Ẩn</span>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @endif
    </div>

    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
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