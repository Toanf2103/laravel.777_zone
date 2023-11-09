<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('employee')->check()){
            return redirect()->route('admin.auth.login');
        }

        if (Auth::guard('employee')->user()->status === 0 || Auth::guard('employee')->user()->role === 'customer') {
            Auth::guard('employee')->logout();
            return redirect()->route('admin.auth.login');
        }

        return $next($request);
    }
}
