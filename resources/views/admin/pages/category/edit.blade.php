@extends('admin.layouts.main')

@section('title', 'Chỉnh sửa danh mục - 777 Zone Admin')
@section('title-content', 'Chỉnh sửa danh mục')

@section('css')
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.categories.index') }}">Danh mục</a></li>
<li class="breadcrumb-item active" aria-current="page">Chỉnh sửa danh mục</li>
@stop

@section('content')
<form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
    <div class="d-flex flex-column gap-4">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $category->id }}">

        @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Lưu thay đổi">
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label fw-bold">Tên danh mục <span class="text-danger">*</span></label>
                @php
                $name = old('name') !== null ? old('name') : $category->name;
                @endphp
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="Nhập tên danh mục" value="{{ $name }}" autocomplete="off">
                @if ($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="status" class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                @php
                $statusChosen = old('status') !== null ? old('status') : $category->status;
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