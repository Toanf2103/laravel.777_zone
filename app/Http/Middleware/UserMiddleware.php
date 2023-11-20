<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct()
    {
        
    }
    public function handle(Request $request, Closure $next): Response
    {
        // dd(2);
        // Kiểm tra xem người dùng đã đăng nhập không
        if (!Auth::guard('user')->check()){
            return redirect()->route('site.home')->with('error','Bạn cần đăng nhập để truy cập trang này!');
        }
        // dd(Auth::guard('user')->check());
        // dd($request);
        return $next($request);
    }
}
