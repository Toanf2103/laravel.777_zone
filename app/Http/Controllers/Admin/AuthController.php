<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\ChangePasswordRequest;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\UpdatePersonalRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.pages.auth.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        if (!Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->back()->with('error', 'Đăng nhập thất bại!');
        }
        if (Auth::guard('admin')->user()->status == 0) {
            Auth::guard('admin')->logout();
            return redirect()->back()->with('error', 'Tài khoản của bạn đã bị cấm sử dụng!');
        }
        if (Auth::guard('admin')->user()->role === 'customer') {
            Auth::guard('admin')->logout();
            return redirect()->back()->with('error', 'Bạn không có quyền truy cập vào trang này!');
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.auth.login');
    }

    public function personal()
    {
        $user = Auth::guard('admin')->user();

        return view('admin.pages.auth.personal', compact('user'));
    }

    public function personalUpdate(UpdatePersonalRequest $request)
    {
        $user = User::where('id', Auth::guard('admin')->user()->id);

        $user->update([
            'full_name' => ucwords($request->full_name),
            'phone_number' => $request->phone_number,
            'email' => $request->input('email'),
            'province_id' => $request->province,
            'district_id' => $request->district,
            'ward_id' => $request->ward,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success_personal', 'Cập nhật thông tin thành công');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('id', Auth::guard('admin')->user()->id)->first();

        if (!Hash::check($request->input('password_old'), $user->password)) {
            return redirect()->back()->with('error_password', 'Mật khẩu cũ không chính xác');
        }

        $user->update([
            'password' => bcrypt($request->input('password_new'))
        ]);

        return redirect()->back()->with('success_password', 'Đổi mật khẩu thành công');
    }
}
