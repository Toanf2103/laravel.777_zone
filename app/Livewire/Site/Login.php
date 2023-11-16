<?php

namespace App\Livewire\Site;

use Livewire\Attributes\Rule;
use App\Services\Site\AuthService;
use Livewire\Component;

class Login extends Component
{
    public $type = 'login';
    public $username;
    public $password;

    public $usernameRegister;
    public $nameRegister;
    public $passwordRegister;

    public $confirmPasswordRegister;




    public function showRegisterForm()
    {
        $this->type = 'alertLogin';
    }

    public function showLoginForm()
    {
        $this->type = 'login';
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
                $this->dispatch('reloadPage', ['timeDelay' => 2]);
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
                $this->dispatch('reloadPage', ['timeDelay' => 2, 'message' => 'Tạo tài khoản thành công!']);
            }
        }
    }



    public function render()
    {
        return view('livewire.site.login');
    }
}
