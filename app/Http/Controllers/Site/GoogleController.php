<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Site\AuthService;
use App\Services\Site\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $data = Socialite::driver('google')->user();
            $user = User::where('email', $data->email)->first();
            if ($user) {
                if (!$user->google_id) {
                    $user->update(['google_id' => $data->id]);
                }
                if($user->status === false){
                    return $this->dataReturn('error', 'Tài khoản của bạn đã bị khóa');
                }
                $user->update(['verification_token' => null]);

                Auth::guard('user')->login($user);
                $message = 'Đăng nhập thành công!';
                return  $this->dataReturn('success', $message);
            }

            $userSerive = new UserService();
            $newUser = $userSerive->createWithSocial([
                'name' => $data->name,
                'email' => $data->email,
                'google_id' => $data->id,
                'avatar' => $data->avatar
            ]);
            // dd($newUser);
            if ($newUser !== false) {
                Auth::guard('user')->login($newUser);
                $message = "Đăng kí tài khoản thành công!";
                return  $this->dataReturn('success', $message);
            }

            $message = 'Có lỗi! thử lại sau';
            return  $this->dataReturn('error', $message);

            

        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return  $this->dataReturn('error', $errorMessage);
        }
    }
    function  dataReturn($type, $mess)
    {
        return "<script>
                window.opener.receiveDataFromGoogleLoginWindow({status:'$type',message:'$mess'});
                window.close();
            </script>";
    }
}
