<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('site.pages.auth.login');
    }
    public function logout(){
        return view('site.pages.auth.login');
    }
    public function register(){
        return view('site.pages.auth.login');
    }
}
