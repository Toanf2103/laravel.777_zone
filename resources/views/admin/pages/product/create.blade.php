@extends('admin.layouts.main')

@section('title', 'Thêm mới sản phẩm - 777 Zone Admin')
@section('title-content', 'Thêm mới sản phẩm')

@section('css')
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
<li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
@stop

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        @csrf

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Tạo mới">
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}" autocomplete="off">
                @if ($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="category" class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('category')) is-invalid @endif" id="category" name="category" required>
                    @foreach($listCategories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                <small class="text-danger">{{ $errors->first('category') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="brand" class="form-label fw-bold">Thương hiệu <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('brand')) is-invalid @endif" id="brand" name="brand" required>
                    @foreach($listBrands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : ''  }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('brand'))
                <small class="text-danger">{{ $errors->first('brand') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="price" class="form-label fw-bold">Đơn giá <span class="text-danger">*</span></label>
                <input type="number" class="form-control @if($errors->has('price')) is-invalid @endif" id="price" name="price" placeholder="Nhập đơn giá" value="{{ old('price') }}" autocomplete="off">
                @if ($errors->has('price'))
                <small class="text-danger">{{ $errors->first('price') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="quantity" class="form-label fw-bold">Số lượng <span class="text-danger">*</span></label>
                <input type="number" class="form-control @if($errors->has('quantity')) is-invalid @endif" id="quantity" name="quantity" placeholder="Nhập số lượng" value="{{ old('quantity') }}" autocomplete="off">
                @if ($errors->has('quantity'))
                <small class="text-danger">{{ $errors->first('quantity') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="images" class="form-label fw-bold">Hình ảnh <span class="text-danger">*</span></label>
                <input type="file" class="form-control @if($errors->has('images')) is-invalid @endif" id="images" name="images[]" accept="image/*" multiple>
                @if ($errors->has('images'))
                <small class="text-danger">{{ $errors->first('images') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="status" class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('status')) is-invalid @endif" id="status" name="status" required>
                    <option value="1" {{ old('status') === 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
                @if ($errors->has('status'))
                <small class="text-danger">{{ $errors->first('status') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group">
                <label for="specs" class="form-label fw-bold">Thông số kỹ thuật</label>
                <textarea class="form-control @if($errors->has('specs')) is-invalid @endif" id="specs" name="specs" placeholder="Nhập thông số kỹ thuật" autocomplete="off" rows="5">{{ old('specs') }}</textarea>
                @if ($errors->has('specs'))
                <small class="text-danger">{{ $errors->first('specs') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group">
                <label for="description" class="form-label fw-bold">Mô tả</label>
                <textarea class="form-control @if($errors->has('description')) is-invalid @endif" id="description" name="description" placeholder="Nhập mô tả" autocomplete="off" rows="5">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <small class="text-danger">{{ $errors->first('description') }}</small>
                @endif
            </div>
        </div>
    </div>
</form>
@stop

@section('js')
@stop