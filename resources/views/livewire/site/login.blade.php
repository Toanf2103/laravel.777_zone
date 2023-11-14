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
        <div class="none" id="warrper-alert-login">
            <div class="alert alert-danger d-flex align-items-center none" role="alert" id="alert-login">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    An example danger alert with an icon
                </div>
            </div>
        </div>
        <div class="form">
            <div class="input-group">
                <label>Tài khoản</label>
                <input type="text" wire:model="username" placeholder="" autocomplete="off">
            </div>
            <div class="input-group pass">
                <label>Mật khẩu</label>
                <div class="input-group-pass">

                    <input type="password" wire:model="password" placeholder="" autocomplete="off">
                    <div class="wrapper-icon icon-toogle-pass" data-show="password-login" onclick="toggleShowPassword('password-login')">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="forgot">
                <a rel="noopener noreferrer" href="#">Quên mật khẩu ?</a>
            </div>
            <button class="sign" wire:click="checkLogin">Đăng nhập</button>
        </div>
        <div class="social-message">
            <div class="line"></div>
            <p class="message">Đăng nhập với</p>
            <div class="line"></div>
        </div>
        <div class="social-icons">

            <button aria-label="Log in with Google" class="icon" onclick="loginHandle()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path d="M16.318 13.714v5.484h9.078c-0.37 2.354-2.745 6.901-9.078 6.901-5.458 0-9.917-4.521-9.917-10.099s4.458-10.099 9.917-10.099c3.109 0 5.193 1.318 6.38 2.464l4.339-4.182c-2.786-2.599-6.396-4.182-10.719-4.182-8.844 0-16 7.151-16 16s7.156 16 16 16c9.234 0 15.365-6.49 15.365-15.635 0-1.052-0.115-1.854-0.255-2.651z">
                    </path>
                </svg>
            </button>

            <!-- <button aria-label="Log in with Twitter" class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path d="M31.937 6.093c-1.177 0.516-2.437 0.871-3.765 1.032 1.355-0.813 2.391-2.099 2.885-3.631-1.271 0.74-2.677 1.276-4.172 1.579-1.192-1.276-2.896-2.079-4.787-2.079-3.625 0-6.563 2.937-6.563 6.557 0 0.521 0.063 1.021 0.172 1.495-5.453-0.255-10.287-2.875-13.52-6.833-0.568 0.964-0.891 2.084-0.891 3.303 0 2.281 1.161 4.281 2.916 5.457-1.073-0.031-2.083-0.328-2.968-0.817v0.079c0 3.181 2.26 5.833 5.26 6.437-0.547 0.145-1.131 0.229-1.724 0.229-0.421 0-0.823-0.041-1.224-0.115 0.844 2.604 3.26 4.5 6.14 4.557-2.239 1.755-5.077 2.801-8.135 2.801-0.521 0-1.041-0.025-1.563-0.088 2.917 1.86 6.36 2.948 10.079 2.948 12.067 0 18.661-9.995 18.661-18.651 0-0.276 0-0.557-0.021-0.839 1.287-0.917 2.401-2.079 3.281-3.396z">
                    </path>
                </svg>
            </button>
            <button aria-label="Log in with GitHub" class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path d="M16 0.396c-8.839 0-16 7.167-16 16 0 7.073 4.584 13.068 10.937 15.183 0.803 0.151 1.093-0.344 1.093-0.772 0-0.38-0.009-1.385-0.015-2.719-4.453 0.964-5.391-2.151-5.391-2.151-0.729-1.844-1.781-2.339-1.781-2.339-1.448-0.989 0.115-0.968 0.115-0.968 1.604 0.109 2.448 1.645 2.448 1.645 1.427 2.448 3.744 1.74 4.661 1.328 0.14-1.031 0.557-1.74 1.011-2.135-3.552-0.401-7.287-1.776-7.287-7.907 0-1.751 0.62-3.177 1.645-4.297-0.177-0.401-0.719-2.031 0.141-4.235 0 0 1.339-0.427 4.4 1.641 1.281-0.355 2.641-0.532 4-0.541 1.36 0.009 2.719 0.187 4 0.541 3.043-2.068 4.381-1.641 4.381-1.641 0.859 2.204 0.317 3.833 0.161 4.235 1.015 1.12 1.635 2.547 1.635 4.297 0 6.145-3.74 7.5-7.296 7.891 0.556 0.479 1.077 1.464 1.077 2.959 0 2.14-0.020 3.864-0.020 4.385 0 0.416 0.28 0.916 1.104 0.755 6.4-2.093 10.979-8.093 10.979-15.156 0-8.833-7.161-16-16-16z">
                    </path>
                </svg>
            </button> -->
        </div>
        <p class="signup">Bạn chưa có tài khoản?
            <a rel="noopener noreferrer" id="btn-swicth-register" wire:click="showRegisterForm">Đăng kí</a>
        </p>
    </div>
    @else
    <div class="form-container" id="register-from">
        <p class="title">Đăng Kí</p>
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
        <div class="none" id="warrper-alert-login">
            <div class="alert alert-danger d-flex align-items-center none" role="alert" id="alert-login">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    An example danger alert with an icon
                </div>
            </div>
        </div>
        <div class="form">
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
                    <div class="wrapper-icon icon-toogle-pass" data-show="new-password" onclick="toggleShowPassword('new-password')">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="input-group pass">
                <label>Nhập lại mật khẩu</label>
                <div class="input-group-pass">

                    <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="" autocomplete="off" wire:model="confirmPasswordRegister">
                    <div class="wrapper-icon icon-toogle-pass" data-show="confirm-new-password" onclick="toggleShowPassword('confirm-new-password')">
                        <i class="fa-regular fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="forgot">
                <!-- <a rel="noopener noreferrer" href="#">Quên mật khẩu ?</a> -->
            </div>
            <button class="sign" id="btn-register-click" wire:click="register">Đăng kí</button>
        </div>
        <div class="social-message">
            <div class="line"></div>
            <p class="message">Đăng kí bằng</p>
            <div class="line"></div>
        </div>
        <div class="social-icons">
            <button aria-label="Log in with Google" class="icon" onclick="loginHandle()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path d="M16.318 13.714v5.484h9.078c-0.37 2.354-2.745 6.901-9.078 6.901-5.458 0-9.917-4.521-9.917-10.099s4.458-10.099 9.917-10.099c3.109 0 5.193 1.318 6.38 2.464l4.339-4.182c-2.786-2.599-6.396-4.182-10.719-4.182-8.844 0-16 7.151-16 16s7.156 16 16 16c9.234 0 15.365-6.49 15.365-15.635 0-1.052-0.115-1.854-0.255-2.651z">
                    </path>
                </svg>
            </button>
            <!-- <button aria-label="Log in with Twitter" class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path d="M31.937 6.093c-1.177 0.516-2.437 0.871-3.765 1.032 1.355-0.813 2.391-2.099 2.885-3.631-1.271 0.74-2.677 1.276-4.172 1.579-1.192-1.276-2.896-2.079-4.787-2.079-3.625 0-6.563 2.937-6.563 6.557 0 0.521 0.063 1.021 0.172 1.495-5.453-0.255-10.287-2.875-13.52-6.833-0.568 0.964-0.891 2.084-0.891 3.303 0 2.281 1.161 4.281 2.916 5.457-1.073-0.031-2.083-0.328-2.968-0.817v0.079c0 3.181 2.26 5.833 5.26 6.437-0.547 0.145-1.131 0.229-1.724 0.229-0.421 0-0.823-0.041-1.224-0.115 0.844 2.604 3.26 4.5 6.14 4.557-2.239 1.755-5.077 2.801-8.135 2.801-0.521 0-1.041-0.025-1.563-0.088 2.917 1.86 6.36 2.948 10.079 2.948 12.067 0 18.661-9.995 18.661-18.651 0-0.276 0-0.557-0.021-0.839 1.287-0.917 2.401-2.079 3.281-3.396z">
                    </path>
                </svg>
            </button>
            <button aria-label="Log in with GitHub" class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path d="M16 0.396c-8.839 0-16 7.167-16 16 0 7.073 4.584 13.068 10.937 15.183 0.803 0.151 1.093-0.344 1.093-0.772 0-0.38-0.009-1.385-0.015-2.719-4.453 0.964-5.391-2.151-5.391-2.151-0.729-1.844-1.781-2.339-1.781-2.339-1.448-0.989 0.115-0.968 0.115-0.968 1.604 0.109 2.448 1.645 2.448 1.645 1.427 2.448 3.744 1.74 4.661 1.328 0.14-1.031 0.557-1.74 1.011-2.135-3.552-0.401-7.287-1.776-7.287-7.907 0-1.751 0.62-3.177 1.645-4.297-0.177-0.401-0.719-2.031 0.141-4.235 0 0 1.339-0.427 4.4 1.641 1.281-0.355 2.641-0.532 4-0.541 1.36 0.009 2.719 0.187 4 0.541 3.043-2.068 4.381-1.641 4.381-1.641 0.859 2.204 0.317 3.833 0.161 4.235 1.015 1.12 1.635 2.547 1.635 4.297 0 6.145-3.74 7.5-7.296 7.891 0.556 0.479 1.077 1.464 1.077 2.959 0 2.14-0.020 3.864-0.020 4.385 0 0.416 0.28 0.916 1.104 0.755 6.4-2.093 10.979-8.093 10.979-15.156 0-8.833-7.161-16-16-16z">
                    </path>
                </svg>
            </button> -->
        </div>
        <p class="signup">Bạn đã có tài khoản?
            <a rel="noopener noreferrer" id="btn-swicth-login" class="" wire:click="showLoginForm">Đăng nhập</a>
        </p>
    </div>
    @endif

    <script>
        function loginHandle () {
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