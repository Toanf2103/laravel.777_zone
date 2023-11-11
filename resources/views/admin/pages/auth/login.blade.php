@extends('admin.layouts.no-partial')

@section('title', 'Đăng nhập')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/login.css') }}">
@stop

@section('content')
<div class="login-container">
    <form method="POST">
        <div class="d-flex flex-column gap-4 p-5">
            <h1 class="title">Đăng nhập Admin</h1>

            @csrf

            @if (session('error'))
            <div class="alert alert-danger m-0">
                {{ session('error') }}
            </div>
            @endif

            <div class="group">
                <div class="txt_field">
                    <input type="text" name='username' required>
                    <span></span>
                    <label>Tài khoản</label>
                </div>
                @if ($errors->has('username'))
                <small class="text-danger">{{ $errors->first('username') }}</small>
                @endif
            </div>

            <div class="group">
                <div class="txt_field">
                    <input type="password" name='password' required>
                    <span></span>
                    <label>Mật khẩu</label>
                </div>
                @if ($errors->has('password'))
                <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            <input type="submit" class="mt-3" value="Đăng nhập">
        </div>
    </form>
</div>
@stop