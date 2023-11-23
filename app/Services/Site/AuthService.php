<?php

namespace App\Services\Site;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function checkLogin($username, $password){

        if($username == null || $password == null){
            return ['status'=>'error','message'=>'Có lỗi! Thử lại sau'];
        }

        if(Auth::guard('user')->check()){
            //do something
        }
        $checkUserName = Auth::guard('user')->attempt(["username"=>$username, "password"=>$password]);
        
        try{

            $checkEmail = Auth::guard('user')->attempt(["email"=>$username, "password"=>$password]);
        }catch(Exception $e){
            $checkEmail = false;
        }
        
        if(!$checkUserName && !$checkEmail){
            return ['status'=>'error','message'=>'Sai thông tin đăng nhập'];
        }

        if (Auth::guard('user')->user()->status == 0){
            return ['status'=>'error','message'=>'Tài khoản đã bị khóa'];
        }

        return ['status'=>'success','message'=>'Đăng nhập thành công'];
    }

    public function register($username,$password,$name){
        $checkUserName = User::where('username',$username)->exists();

        if($checkUserName){
            return ['status'=>'error','message'=>'Tên tài khoản đã đưọc sử dụng, vui lòng chọn tên khác'];
        }
        
        User::create(['username' => $username, 'password' => bcrypt($password), 'role' => 'customer', 'full_name' => $name]);
        Auth::guard('user')->attempt(["username"=>$username, "password"=>$password]);
        return ['status'=>'success','message'=>'Đăng kí tài khoản thành công'];

    }

    public function logout() {
        Auth::guard('user')->logout();
        return ['status'=>'success'];;
    }

    
}
