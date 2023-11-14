@extends('admin.layouts.main')

@section('title', 'Thiết lập về tôi - 777 Zone Admin')
@section('title-content', 'Thiết lập về tôi')

@section('css')
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Thiết lập về tôi</li>
@stop

@section('content')
<form action="{{ route('admin.auth.personal.update') }}" method="POST">
    <div class="row">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user->id }}">

        @if (session('success_personal'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success_personal') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Lưu thay đổi">
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="full_name" class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('full_name')) is-invalid @endif" id="full_name" name="full_name" placeholder="Nhập họ và tên" value="{{ old('full_name') ? old('full_name') : $user->full_name }}" autocomplete="off">
                @if ($errors->has('full_name'))
                <small class="text-danger">{{ $errors->first('full_name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="phone_number" class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('phone_number')) is-invalid @endif" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" value="{{ old('phone_number') ? old('phone_number') : $user->phone_number }}" autocomplete="off">
                @if ($errors->has('phone_number'))
                <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="text" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" placeholder="Nhập email" value="{{ old('email') ? old('email') : $user->email }}" autocomplete="off">
                @if ($errors->has('email'))
                <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="username" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control" id="username" value="{{ $user->username }}" disabled>
            </div>
        </div>

        <div class="col-12 col-md-6 mt-4">
            <div class="form-group">
                <label for="province" class="form-label fw-bold">Tỉnh thành <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('province')) is-invalid @endif" id="province" name="province" data-id="{{ old('province') ? old('province') : $user->province_id }}" required>
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
                <select class="form-select @if($errors->has('district')) is-invalid @endif" id="district" name="district" data-id="{{ old('district') ? old('district') : $user->district_id }}" required>
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
                <select class="form-select @if($errors->has('ward')) is-invalid @endif" id="ward" name="ward" data-id="{{ old('ward') ? old('ward') : $user->ward_id }}" required>
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
                <input type="text" class="form-control @if($errors->has('address')) is-invalid @endif" id="address" name="address" placeholder="Nhập địa chỉ cụ thể" value="{{ old('address') ? old('address') : $user->address }}" autocomplete="off">
                @if ($errors->has('address'))
                <small class="text-danger">{{ $errors->first('address') }}</small>
                @endif
            </div>
        </div>
    </div>
</form>

<hr class="my-5">

<form action="{{ route('admin.auth.changePassword') }}" method="POST">
    <div class="row mb-5">
        @csrf

        <h1 class="fw-bold" style="font-size: 1.8rem;">Thiết lập mật khẩu mới</h1>

        @if (session('success_password'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success_password') }}
            </div>
        </div>
        @endif

        @if (session('error_password'))
        <div class="col-12">
            <div class="alert alert-danger">
                {{ session('error_password') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Lưu thay đổi">
        </div>

        <div class="col-12 col-md-4 mt-4">
            <div class="form-group">
                <label for="password_old" class="form-label fw-bold">Mật khẩu cũ <span class="text-danger">*</span></label>
                <input type="password" class="form-control @if($errors->has('password_old')) is-invalid @endif" id="password_old" name="password_old" placeholder="Nhập mật khẩu cũ" value="{{ old('password_old') }}" autocomplete="off">
                @if ($errors->has('password_old'))
                <small class="text-danger">{{ $errors->first('password_old') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-4 mt-4">
            <div class="form-group">
                <label for="password_new" class="form-label fw-bold">Mật khẩu mới <span class="text-danger">*</span></label>
                <input type="password" class="form-control @if($errors->has('password_new')) is-invalid @endif" id="password_new" name="password_new" placeholder="Nhập mật khẩu mới" value="{{ old('password_new') }}" autocomplete="off">
                @if ($errors->has('password_new'))
                <small class="text-danger">{{ $errors->first('password_new') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-4 mt-4">
            <div class="form-group">
                <label for="password_new_confirm" class="form-label fw-bold">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                <input type="password" class="form-control @if($errors->has('password_new_confirm')) is-invalid @endif" id="password_new_confirm" name="password_new_confirm" placeholder="Nhập mật khẩu xác nhận mới" value="{{ old('password_new_confirm') }}" autocomplete="off">
                @if ($errors->has('password_new_confirm'))
                <small class="text-danger">{{ $errors->first('password_new_confirm') }}</small>
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