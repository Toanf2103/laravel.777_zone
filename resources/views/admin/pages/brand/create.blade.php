@extends('admin.layouts.main')

@section('title', 'Thêm mới thương hiệu - 777 Zone Admin')
@section('title-content', 'Thêm mới thương hiệu')

@section('css')
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.brands.index') }}">Thương hiệu</a></li>
<li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
@stop

@section('content')
<form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
    <div class="d-flex flex-column gap-4">
        @csrf

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Tạo mới">
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label fw-bold">Tên thương hiệu <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="Nhập tên thương hiệu" value="{{ old('name') }}" autocomplete="off">
                @if ($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
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