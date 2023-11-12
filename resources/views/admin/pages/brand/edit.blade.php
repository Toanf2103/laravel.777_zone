@extends('admin.layouts.main')

@section('title', 'Cập nhật thông tin thương hiệu - 777 Zone Admin')
@section('title-content', 'Cập nhật thông tin thương hiệu')

@section('css')
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.brands.index') }}">Thương hiệu</a></li>
<li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
@stop

@section('content')
<form action="{{ route('admin.brands.update', ['brand' => $brand->id]) }}" method="POST" enctype="multipart/form-data">
    <div class="d-flex flex-column gap-4">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $brand->id }}">

        <div>
            @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            @if (session('warning'))
            <div class="col-12">
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            </div>
            @endif
        </div>

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Lưu thay đổi">
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label fw-bold">Tên thương hiệu <span class="text-danger">*</span></label>
                @php
                $name = old('name') !== null ? old('name') : $brand->name;
                @endphp
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="Nhập tên thương hiệu" value="{{ $name }}" autocomplete="off">
                @if ($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-label fw-bold">Hình ảnh mới</label>
                <input type="file" class="form-control @if($errors->has('image')) is-invalid @endif" id="image" name="image" accept="image/*">
                @if ($errors->has('image'))
                <small class="text-danger">{{ $errors->first('image') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="status" class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                @php
                $statusChosen = old('status') !== null ? old('status') : $brand->status;
                @endphp
                <select class="form-select @if($errors->has('status')) is-invalid @endif" id="status" name="status" required>
                    <option value="1" {{ $statusChosen == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $statusChosen == 0 ? 'selected' : '' }}>Ẩn</option>
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