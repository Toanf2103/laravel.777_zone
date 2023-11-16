<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\AuthService;
use Illuminate\Http\Request;

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
}
