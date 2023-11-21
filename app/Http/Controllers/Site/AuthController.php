<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ChangeAvatarRequest;
use App\Http\Requests\Site\ChangeInfoRequest;
use App\Http\Requests\Site\ChangePassRequest;
use App\Models\User;
use App\Services\Site\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login()
    {
        return view('site.pages.auth.login');
    }

    public function logout()
    {
        $rs = $this->authService->logout();
        return redirect()->back();
    }

    public function register()
    {
        return view('site.pages.auth.login');
    }

    public function editProfile()
    {
        $user = Auth::guard('user')->user();
        // dd($user);
        return view('site.pages.auth.editProfile', compact('user'));
    }

    public function changeInfo(ChangeInfoRequest $rq)
    {
        // dd($rq->all());
        $user = User::where('id', Auth::guard('user')->user()->id)->first();
        $user->full_name = $rq->full_name;
        if ($rq->phone_number) {
            $user->phone_number = $rq->phone_number;
        }
        if ($rq->ward) {
            $user->ward_id = $rq->ward;
        }
        if ($rq->district) {
            $user->district_id = $rq->district;
        }
        if ($rq->province) {
            $user->province_id = $rq->province;
        }
        if($user->email===null){
            $user->email = $rq->email;
        }
        if($rq->address){
            $user->address = $rq->address;
        }

        $user->save();
        // dd(1);
        return redirect()->back()->with('alert', 'Sửa thông tin thành công');
    }

    public function changePassView()
    {
        return view('site.pages.auth.changePass');
    }
    public function changePass(ChangePassRequest $rq)
    {
        // dd($rq->all());
        // dd(1);
        // dd($rq->current_pass);
        $user = User::where('id', Auth::guard('user')->user()->id)->first();
        if(!password_verify($rq->current_pass,$user->password)){
            return redirect()->back()->with('alert',['status' => 'error','message'=>'Sai mật khẩu!'] );

        }
        if ($rq->new_pass !== $rq->cofirm_new_pass) {
            return redirect()->back()->with('alert', ['status' => 'error','message'=>'Mật khẩu xác nhận không đúng!']);
        }

    //    dd(1);
        $user->password = bcrypt($rq->new_pass);
        $user->save();
        return redirect()->back()->with('alert', ['status' => 'success','message'=>'Đổi mật khẩu thành công']);

    }
    public function avatar(){
        $user = Auth::guard('user')->user();
        return view('site.pages.auth.changeAvatar',compact('user'));
    }

    public function changeAvatar(ChangeAvatarRequest $rq){
        dd(1);
    }
   
}
