@extends('site.layouts.main')
@section('title', 'Đổi avatar')

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
            Đổi avatar
        </h1>
        <form action="{{ route('site.auth.changeAvatar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--Avatar-->
            <div>
                <div class="d-flex justify-content-center mb-4">
                    <img id="selectedAvatar" src="{{ $user->avatar??'https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg'}} " class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary btn-rounded me-4">
                        <label class="form-label text-white m-1" for="avatar">Choose file</label>
                        <input type="file" accept="image/*" name="avatar" class="form-control d-none" id="avatar" />
                    </div>
                    <button id="submit" type="submit" class="btn btn-success" disabled>Lưu</button>
                    @if ($errors->has('avatar'))
                    <small class="text-danger">{{ $errors->first('avatar') }}</small>
                    @endif
                </div>
            </div>
        </form>

    </div>
</div>



@stop

@section('js')

<script>
    const avatarElm = document.getElementById('avatar');
    const submitElm = document.getElementById('submit');
    const selectedAvatarElm = document.getElementById('selectedAvatar');
    avatarElm.addEventListener('change', (e) => {
        submitElm.disabled = false;
        const url = URL.createObjectURL(e.target.files[0]);
        selectedAvatarElm.src = url;
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