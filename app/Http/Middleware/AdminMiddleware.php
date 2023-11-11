<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.auth.login')->with('error', 'Vui lòng đăng nhập');
        }
        if (Auth::guard('admin')->user()->status === 0) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.auth.login')->with('error', 'Tài khoản của bạn đã bị cấm sử dụng');
        }
        if (Auth::guard('admin')->user()->role !== 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.auth.login')->with('error', 'Bạn không có quyền truy cập vào trang này');
        }

        return $next($request);
    }
}
