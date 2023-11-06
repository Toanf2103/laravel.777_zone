<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('site.pages.home');
    }

    public function catelory(){
        return view('site.pages.catelory');
    }

    public function product(){
        return view('site.pages.product');
    }

    public function cart(){
        return view('site.pages.product');
    }
}
