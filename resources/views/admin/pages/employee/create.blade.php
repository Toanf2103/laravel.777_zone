@extends('admin.layouts.main')

@section('title', 'Thêm mới nhân viên - 777 Zone Admin')
@section('title-content', 'Thêm mới nhân viên')

@section('css')
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.employees.index') }}">Nhân viên</a></li>
<li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
@stop

@section('content')
<form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        @csrf

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Tạo mới">
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="full_name" class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('full_name')) is-invalid @endif" id="full_name" name="full_name" placeholder="Nhập họ và tên" value="{{ old('full_name') }}" autocomplete="off">
                @if ($errors->has('full_name'))
                <small class="text-danger">{{ $errors->first('full_name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <div class="form-group">
                <label for="phone_number" class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('phone_number')) is-invalid @endif" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" value="{{ old('phone_number') }}" autocomplete="off">
                @if ($errors->has('phone_number'))
                <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="text" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" placeholder="Nhập email" value="{{ old('email') }}" autocomplete="off">
                @if ($errors->has('email'))
                <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="username" class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" id="username" name="username" placeholder="Nhập username" value="{{ old('username') }}" autocomplete="off">
                @if ($errors->has('username'))
                <small class="text-danger">{{ $errors->first('username') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="province" class="form-label fw-bold">Tỉnh thành <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('province')) is-invalid @endif" id="province" name="province" data-id="{{ old('province') }}" required>
                    <option value="" disabled selected>---CHỌN TỈNH THÀNH---</option>
                </select>
                @if ($errors->has('province'))
                <small class="text-danger">{{ $errors->first('province') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="district" class="form-label fw-bold">Quận huyện <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('district')) is-invalid @endif" id="district" name="district" data-id="{{ old('district') }}" required>
                    <option value="" disabled selected>---CHỌN QUẬN HUYỆN---</option>
                </select>
                @if ($errors->has('district'))
                <small class="text-danger">{{ $errors->first('district') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="ward" class="form-label fw-bold">Phường xã <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('ward')) is-invalid @endif" id="ward" name="ward" data-id="{{ old('ward') }}" required>
                    <option value="" disabled selected>---CHỌN PHƯỜNG XÃ---</option>
                </select>
                @if ($errors->has('ward'))
                <small class="text-danger">{{ $errors->first('ward') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="address" class="form-label fw-bold">Địa chỉ cụ thể <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('address')) is-invalid @endif" id="address" name="address" placeholder="Nhập địa chỉ cụ thể" value="{{ old('address') }}" autocomplete="off">
                @if ($errors->has('address'))
                <small class="text-danger">{{ $errors->first('address') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="status" class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('status')) is-invalid @endif" id="status" name="status" required>
                    <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Khóa</option>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{ url('public/assets/js/address.js') }}"></script>

<script>
    renderAddress('#province', '#district', '#ward')
</script>
@stop