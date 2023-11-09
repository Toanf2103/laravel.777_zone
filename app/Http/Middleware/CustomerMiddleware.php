<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('cus')->check()) {
            return redirect()->route('site.login')->with('error', 'Vui lòng đăng nhập');
        }
        if (Auth::guard('cus')->user()->status === 0) {
            Auth::guard('cus')->logout();
            return redirect()->route('site.login')->with('error', 'Tài khoản của bạn đã bị cấm sử dụng');
        }
        return $next($request);
    }
}
