@extends('site.layouts.main')
@section('title', 'Đổi mật khẩu')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/pages/profile.css') }}">


@stop

@section('title-page')
@stop

@section('content')

<div class="row gap-3">
    <div class="col-3 right">
        <a href="{{ route('site.auth.edit') }}" class="d-flex align-items-center gap-3 nav-item">
            <div class="wrapper-icon">
                <i class="fa-duotone fa-address-card"></i>
            </div>
            <div class="d-flex align-items-center">
                <p>Thông tin cá nhân</p>
            </div>
        </a>
        <a href="{{ route('site.auth.pass') }}" class="d-flex align-items-center gap-3 nav-item">
            <div class="wrapper-icon">
                <i class="fa-sharp fa-solid fa-lock"></i>
            </div>
            <div class="d-flex align-items-center">
                <p>Đổi mật khẩu</p>
            </div>
        </a>
        <a href="{{ route('site.auth.avatar') }}" class="d-flex align-items-center gap-3 nav-item">
            <div class="wrapper-icon">
                <i class="fa-sharp fa-solid fa-image"></i>
            </div>
            <div class="d-flex align-items-center">
                <p>Đổi avatar</p>
            </div>
        </a>

    </div>
    <div class="col-8 left">
        <h1 class="title-profile">
            Đổi mật khẩu
        </h1>
        <form action="{{ route('site.auth.changePass') }}" method="POST">
            @csrf
            @if(Auth::guard('user')->user()->password !== null)
            <div class="mb-4">
                <label for="current_pass" class="form-label">Mật khẩu hiện tại:</label>
                <input type="password" name="current_pass" class="form-control" id="current_pass" placeholder="Mật khẩu hiện tại">
                @if ($errors->has('current_pass'))
                <small class="text-danger">{{ $errors->first('current_pass') }}</small>
                @endif
            </div>
            @endif

            <div class="mb-4">
                <label for="new_pass" class="form-label">Mật khẩu mới:</label>
                <input type="password" name="new_pass" class="form-control" id="new_pass" placeholder="Mật khẩu mới">
                @if ($errors->has('new_pass'))
                <small class="text-danger">{{ $errors->first('new_pass') }}</small>
                @endif
            </div>
            <div class="mb-4">
                <label for="cofirm_new_pass" class="form-label">Xác nhận mật khẩu mới:</label>
                <input type="password" name="cofirm_new_pass" class="form-control" id="cofirm_new_pass" placeholder="Xác nhận mật khẩu mới">
                @if ($errors->has('cofirm_new_pass'))
                <small class="text-danger">{{ $errors->first('cofirm_new_pass') }}</small>
                @endif
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success" disabled id="submit">Lưu</button>
            </div>
        </form>

    </div>
</div>



@stop

@section('js')
<script>
    const inputElms = document.querySelectorAll('input');
    const btnSubmit = document.getElementById('submit');

    inputElms.forEach(function(elm) {
        elm.addEventListener('input', (e) => {
            btnSubmit.disabled = false;
        });
    });
</script>

@if(session('alert'))
<script>
    alertCustom({
        message: "{{ session('alert')['message'] }}",
        type: "{{ session('alert')['status'] }}",
        duration: 5000
    });
</script>
@endif
@stop