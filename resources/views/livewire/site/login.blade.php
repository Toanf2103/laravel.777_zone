<div>
    @if($type == 'login')
    <div class="form-container" id="login-form">
        <p class="title" wire:click="$refresh">Đăng nhập</p>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>
        <form class="form" wire:submit="checkLogin">
            <div class="input-group">
                <label>Tài khoản</label>
                <input type="text" wire:model="username" placeholder="" autocomplete="off">
            </div>
            <div class="input-group pass">
                <label>Mật khẩu</label>
                <div class="input-group-pass">

                    <input type="password" wire:model="password" placeholder="" autocomplete="off">
                    <div class="wrapper-icon icon-toogle-pass" data-show="password-login" onclick="toggleShowPassword(this)">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="forgot">
                <a rel="noopener noreferrer" wire:click="showForgotPassForm">Quên mật khẩu ?</a>
            </div>
            <button class="sign" wire:loading.remove wire:target="checkLogin">
                Đăng nhập
            </button>
            <button class="sign" disabled wire:loading wire:target="checkLogin">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Đang đăng nhập...
            </button>
        </form>
        <div class="social-message">
            <div class="line"></div>
            <p class="message">Đăng nhập với</p>
            <div class="line"></div>
        </div>
        <div class="social-icons">

            <button aria-label="Log in with Google" class="icon" onclick="loginHandle()">
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 48 48">
                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                    <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                    <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                </svg>
            </button>

        </div>
        <p class="signup">Bạn chưa có tài khoản?
            <a rel="noopener noreferrer" id="btn-swicth-register" wire:click="showRegisterForm">Đăng ký</a>
        </p>
    </div>
    @elseif($type == 'register')
    <div class="form-container" id="register-from">
        <p class="title">Đăng Ký</p>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>
        <form class="form" wire:submit="register">
            <div class="input-group">
                <label>Tài khoản</label>
                <input type="text" name="username" id="username-register" wire:model="usernameRegister" autocomplete="off">
            </div>
            <div class="input-group">
                <label>Tên</label>
                <input type="text" name="name" id="name-register" placeholder="" autocomplete="off" wire:model="nameRegister">
            </div>
            <div class="input-group pass">
                <label>Mật khẩu</label>
                <div class="input-group-pass">

                    <input type="password" name="new-password" id="new-password" placeholder="" autocomplete="off" wire:model="passwordRegister">
                    <div class="wrapper-icon icon-toogle-pass" data-show="new-password" onclick="toggleShowPassword(this)">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="input-group pass">
                <label>Nhập lại mật khẩu</label>
                <div class="input-group-pass">

                    <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="" autocomplete="off" wire:model="confirmPasswordRegister">
                    <div class="wrapper-icon icon-toogle-pass" data-show="confirm-new-password" onclick="toggleShowPassword(this)">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="forgot">
                <!-- <a rel="noopener noreferrer" href="#">Quên mật khẩu ?</a> -->
            </div>
            <button class="sign" wire:loading.remove wire:target="register">
                Đăng ký
            </button>

            <button class="sign" id="btn-register-click" wire:loading wire:target="register">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Đang đăng ký...
            </button>
        </form>
        <div class="social-message">
            <div class="line"></div>
            <p class="message">Đăng ký bằng</p>
            <div class="line"></div>
        </div>
        <div class="social-icons">
            <button aria-label="Log in with Google" class="icon" onclick="loginHandle()">
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 48 48">
                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                    <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                    <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                </svg>
            </button>
        </div>
        <p class="signup">Bạn đã có tài khoản?
            <a rel="noopener noreferrer" id="btn-swicth-login" class="" wire:click="showLoginForm">Đăng nhập</a>
        </p>
    </div>
    @elseif($type=='forgotPassword')
    @if($checkMailConfirm === false)
    <div class="form-container" id="login-form">
        <p class="title" wire:click="$refresh">Quên mật khẩu</p>


        <form class="form" wire:submit="checkEmail">
            <div class="input-group">
                <label>Nhập email</label>
                <input type="text" wire:model="emailForgot" placeholder="" autocomplete="off">
            </div>
            <button class="sign mt-5 mb-5" wire:loading.remove wire:target="checkEmail">
                Xác nhận
            </button>
            <button class="sign mt-5 mb-5" disabled wire:loading wire:target="checkEmail">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Đang xác nhận...
            </button>
        </form>
        <p class="signup">Quay lại đăng nhập
            <a rel="noopener noreferrer" id="btn-swicth-register" wire:click="showLoginForm">Đăng nhập</a>
        </p>
    </div>
    @else
    <div class="form-container" id="login-form">
        <p class="title" wire:click="$refresh">Nhập mã xác nhận</p>


        <div class="form">
            <div class="input-group">
                <label>Nhập mã xác nhận</label>
                <input name="verification" type="text" wire:model="verification" placeholder="" autocomplete="off">
            </div>
            <button class="sign mt-5 mb-5" wire:click="checkVerificationF" wire:loading.remove wire:target="checkVerificationF">
                Xác nhận
            </button>
            <button class="sign mt-5 mb-5" disabled wire:loading wire:target="checkVerificationF">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Đang xác nhận...
            </button>
        </div>
        <p class="signup">Quay lại
            <a rel="noopener noreferrer" id="btn-swicth-register" wire:click="showForgotPassForm">Nhập lại email</a>
        </p>
    </div>
    @endif
    @elseif($type=='changepassword')
    <div class="form-container" id="login-form">
        <p class="title" wire:click="$refresh">Đổi mật khẩu</p>


        <form class="form" wire:submit="changePass">
            <div class="input-group">
                <label>Mật khẩu mới</label>
                <input type="password" wire:model="newPass" placeholder="" autocomplete="off">
            </div>
            <div class="input-group">
                <label>Nhập lại mật khẩu mới</label>
                <input type="password" wire:model="newPassConfirm" placeholder="" autocomplete="off">
            </div>
            <button class="sign mt-5 mb-5" wire:loading.remove wire:target="changePass">
                Xác nhận
            </button>
            <button class="sign mt-5 mb-5" disabled wire:loading wire:target="changePass">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Đang đổi mật...
            </button>
        </form>
        <p class="signup">Quay lại
            <a rel="noopener noreferrer" id="btn-swicth-register" wire:click="showForgotPassForm">Nhập lại email</a>
        </p>
    </div>

    @endif

    <script>
        function loginHandle() {
            let googleLoginWindow = null;
            var width = 500
            var height = 700
            var left = (screen.width - width) / 2
            var top = (screen.height - height) / 2
            var params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
                  width=${width},height=${height},left=${left},top=${top}`
            googleLoginWindow = window.open(`{{ route('site.auth.redirectToGoogle') }}`, 'myWindow', params)
        }
    </script>

</div>