@extends('admin.layouts.main')

@section('title', 'Thêm mới banner - 777 Zone Admin')
@section('title-content', 'Thêm mới banner')

@section('css')
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.banners.index') }}">Banner</a></li>
<li class="breadcrumb-item active" aria-current="page">Thêm mới banner</li>
@stop

@section('content')
<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
    <div class="d-flex flex-column gap-4">
        @csrf

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Tạo mới">
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="category" class="form-label fw-bold">Nơi hiển thị <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('categories')) is-invalid @endif" id="category" name="category">
                    <option value="" {{ old('category') == '' ? 'selected' : '' }}>Trang chủ</option>
                    @foreach ($listCategories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>Danh mục / {{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                <small class="text-danger">{{ $errors->first('category') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="link" class="form-label fw-bold">Link trỏ đến (Bỏ trống để trỏ đến NƠI HIỂN THỊ)</label>
                <input type="text" class="form-control @if($errors->has('link')) is-invalid @endif" id="link" name="link" placeholder="Nhập link trỏ đến" value="{{ old('link') }}" autocomplete="off">
                @if ($errors->has('link'))
                <small class="text-danger">{{ $errors->first('link') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-label fw-bold">Hình ảnh <span class="text-danger">*</span></label>
                <input type="file" class="form-control @if($errors->has('image')) is-invalid @endif" id="image" name="image" accept="image/*">
                @if ($errors->has('image'))
                <small class="text-danger">{{ $errors->first('image') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
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
    </div>
</form>
@stop

@section('js')
@stop