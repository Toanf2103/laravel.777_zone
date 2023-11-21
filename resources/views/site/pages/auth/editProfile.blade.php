@extends('site.layouts.main')
@section('title', 'Đổi thông tin cá nhân')

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
        @if(session('alert'))
        <div class="alert alert-success">
            {{ session('alert') }}
        </div>
        @endif
        <h1 class="title-profile">
            Thông tin cá nhân
        </h1>
        <form action="{{ route('site.auth.changeInfo') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="full_name" value="{{ $user->full_name }}" class="form-control" id="name" placeholder="Tên">
                @if ($errors->has('full_name'))
                <small class="text-danger">{{ $errors->first('full_name') }}</small>
                @endif
            </div>
            <div class="mb-4">
                <label for="Email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="name" placeholder="email" {{ $user->email!=null ?'disabled':'' }}>
                @if ($errors->has('email'))
                <small class="text-danger">{{ $errors->first('email') }}</small>
                @else
                <small class="text-warning"> Bạn chỉ có thể thay đổi địa chỉ email 1 lần</small>
                @endif
            </div>

            <div class="mb-4">
                <label for="formGroupExampleInput" class="form-label">Số điện thoại</label>
                <input type="tel" pattern="[0-9]{10}" name="phone_number" value="{{ $user->phone_number }}" class="form-control" id="formGroupExampleInput" placeholder="Số điện thoại">
                @if ($errors->has('phone_number'))
                <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                @endif
            </div>

            <div class="mb-4">
                <label for="" class="form-label">Địa chỉ</label>
                <input type="text" name="address" value="{{ $user->address }}" class="form-control" id="" placeholder="Địa chỉ">
                @if ($errors->has('address'))
                <small class="text-danger">{{ $errors->first('address') }}</small>
                @endif
            </div>

            <div class="mb-4">
                <label for="province" class="form-label">Tỉnh thành:</label>
                <select name="province" id="province" class="form-select" data-id="{{ $user->province_id }}">
                    <option value="" disabled selected>---CHỌN TỈNH THÀNH---</option>
                </select>
                <div class="invalid-feedback">
                    Chọn tỉnh/thành
                </div>
            </div>
            <div class="mb-3">
                <label for="district" class="form-label">Quận huyện:</label>
                <select name="district" id="district" class="form-select" data-id="{{ $user->district_id }}">
                    <option value="" disabled selected>---CHỌN QUẬN HUYỆN---</option>
                </select>
                <div class="invalid-feedback">
                    Chọn Quận/Huyện
                </div>
            </div>
            <div class="mb-4">
                <label for="ward" class="form-label">Phường xã:</label>
                <select name="ward" id="ward" class="form-select" data-id="{{ $user->ward_id }}">
                    <option value="" disabled selected>---CHỌN PHƯỜNG XÃ---</option>
                </select>
                <div class="invalid-feedback">
                    Chọn Phường/Xã
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success" id="submit" disabled>Lưu</button>
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
        elm.addEventListener('change', (e) => {
            btnSubmit.disabled = false;
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{ url('public/assets/js/address.js') }}"></script>
<script>
    renderAddress('#province', '#district', '#ward')
</script>

<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@stop