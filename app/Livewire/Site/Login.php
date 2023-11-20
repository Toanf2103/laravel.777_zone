<?php

namespace App\Livewire\Site;

use Livewire\Attributes\Rule;
use App\Services\Site\AuthService;
use App\Services\Site\UserService;
use Livewire\Component;
use PDO;

class Login extends Component
{
    public $type = 'login';
    public $username;
    public $password;

    public $usernameRegister;
    public $nameRegister;
    public $passwordRegister;
    public $confirmPasswordRegister;

    public $emailForgot = '';
    public $checkMailConfirm = false;
    public $verification = '';
    public $checkVerification = false;

    public $newPass='';
    public $newPassConfirm='';






    public function showRegisterForm()
    {
        $this->type = 'register';
    }

    public function showLoginForm()
    {
        $this->type = 'login';

        $this->emailForgot = '';
        $this->checkMailConfirm = false;
        $this->verification = '';
        $this->checkVerification = false;
    }
    public function showForgotPassForm()
    {
        $this->type = 'forgotPassword';
        $this->emailForgot = '';
        $this->checkMailConfirm = false;
        $this->verification = '';
        $this->checkVerification = false;
    }

    public function showAlret($title, $mess, $icon)
    {
        $this->dispatch('alertLogin', [
            'title' => $title,
            'mess' => $mess,
            'icon' => $icon
        ]);
    }


    public function checkLogin()
    {
        if ($this->username == null || $this->password == null) {
            $this->showAlret("Vui lòng nhập đầy đủ thông tin", 'Nhập đầy đủ thông tin', 'error');
        } else {
            // dd($this->username);
            $authSer = new AuthService();
            $rs = $authSer->checkLogin($this->username, $this->password);
            if ($rs['status'] == 'success') {
                $this->dispatch('reloadPage', ['timeDelay' => 1]);
            } else {
                $this->showAlret('Sai thông tin đăng nhập', $rs['message'], 'error');
            }
        }
        // $this->dispatch('reloadPage');
    }

    public function register()
    {
        // dd($this->usernameRegister);
        if ($this->usernameRegister == null || $this->nameRegister == null || $this->passwordRegister == null || $this->confirmPasswordRegister == null) {
            $this->showAlret("Vui lòng nhập đầy đủ thông tin", 'Nhập đầy đủ thông tin', 'error');
        } else if ($this->passwordRegister !== $this->confirmPasswordRegister) {
            $this->showAlret("Mật khẩu xác nhận không chính xác", 'Mật khẩu xác nhận không chính xác', 'error');
        } else {
            $authSer = new AuthService();
            $rs = $authSer->register($this->usernameRegister, $this->passwordRegister, $this->nameRegister);
            if ($rs['status'] == 'error') {
                $this->showAlret('Có lỗi', $rs['message'], 'error');
            } else {
                $this->dispatch('reloadPage', ['timeDelay' => 1, 'message' => 'Tạo tài khoản thành công!']);
            }
        }
    }

    public function checkEmail()
    {
        if ($this->emailForgot == '' || $this->emailForgot == null) {
            $this->showAlret('Email trống', 'Vui lòng nhập email!', 'warning');
            $this->skipRender();
            return;
        }
        $userService = new UserService();
        $this->checkMailConfirm  = $userService->checkMailExists($this->emailForgot);
        if ($this->checkMailConfirm !== false) {
            $userService->sendVerificationToken($this->emailForgot);
            $this->showAlret('Chúng tôi đã gửi mã xác nhận về mail bạn', 'Vui lòng nhập kiểm tra!', 'success');
            
            return;
        } else {
            $this->showAlret('Email không đúng!', 'Email không khớp với bất kì tài khoản nào', 'error');
            $this->skipRender();
            return;
        }
    }

    public function checkVerificationF()
    {
        // dd(1);
        $userService = new UserService();
        if ($this->verification == null || $this->verification == '') {
            $this->showAlret('Mã xác nhận trống', 'Vui lòng nhập mã xác nhận', 'warning');
            $this->skipRender();
            return;
        }
        $check = $userService->checkVerificationToken($this->emailForgot,$this->verification);
        // dd(1);

        if($check['status'] == 'error') {
            $this->showAlret($check['message'], 'Vui lòng thử lại', 'error');
            $this->skipRender();
            return;
        }
        if($check['status'] == 'success') {
            $this->checkVerification = true;
            $this->showAlret('Đổi mật khẩu', 'vui lòng đổi mật khẩu', 'success');
            $this->type='changepassword';
            return;
        }
        
    }

    public function changePass(){
        // dd($this->newPass);
        if($this->newPass == '' || $this->newPass == null || $this->newPassConfirm=='' || $this->newPassConfirm==null){
            $this->showAlret('Mật khẩu trống', 'Vui lòng nhập đầy đủ', 'error');
            $this->skipRender();
            return;
        }
        if($this->newPass != $this->newPassConfirm){
            $this->showAlret('Mật khẩu xác nhận không trùng khớp', 'Mật khẩu xác nhận không trùng khớp', 'error');
            $this->skipRender();
            return;
        }
        $userSer = new UserService();
        $check = $userSer->changePass($this->newPass,$this->emailForgot);
        if($check){
            $this->showAlret('Dổi mật khẩu thành công', 'Vui lòng đăng nhập', 'success');
            $this->type = 'login';
            return;
            
        }else{
            $this->showAlret('Dổi mật khẩu thất bại', 'Vui lòng thử lại', 'error');
            return;
        }
    }


    public function render()
    {
        return view('livewire.site.login');
    }
}
