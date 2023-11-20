<?php

namespace App\Services\Site;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UserService
{

    public function createWithSocial($data)
    {
        try {
            $newUser = User::create(
                [
                    'email' => $data['email'],
                    'role' => 'customer',
                    'full_name' => $data['name'],
                    'avatar' => $data['avatar'],
                    'google_id' => $data['google_id']
                ]
            );
            return $newUser;
        } catch (Exception $e) {
            return false;
        }
    }
    public function checkMailExists($email)
    {
        return User::where('email', $email)->exists();
    }
    public function sendVerificationToken($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $token = rand(100000, 999999);
            Mail::send(
                'site.partials.emailsForgotPass',
                compact('token'),
                function ($e) use ($email) {
                    $e->subject('Mã xác nhận của bạn');
                    $e->to($email);
                }
            );
            $user->verification_token = $token;
            $user->last_email_sent_at = Carbon::now();
            $user->save();
            return true;
        }
        return false;
    }
    public function checkVerificationToken($email, $token)
    {
        $timeMax = 30;
        $user = User::where('email', $email)->where('verification_token', $token)->first();
        // dd($email);
        if ($user) {
            // Chuyển đổi thành đối tượng Carbon
            $carbonDateTime = Carbon::parse($user->last_email_sent_at);

            // Lấy thời điểm hiện tại
            $now = Carbon::now();

            // Tính khoảng cách giữa hai thời điểm
            $diffInMinutes = $now->diffInMinutes($carbonDateTime);

            if($diffInMinutes > $timeMax){
                return ['status' => 'error', 'message' =>'Mã xác nhận hết hạn'];
            }
            return ['status' => 'success', 'message' =>'Vui lòng đổi mật khẩu'];
        }
        return ['status' => 'error', 'message' =>'Mã xác không chính xác'];
    }

    public function changePass($newPass,$email){
        $user = User::where('email', $email)->first();
        if($user){
            $user->password = bcrypt($newPass);
            $user->save();
            return true;
        }
        return false;
        
    }
}
