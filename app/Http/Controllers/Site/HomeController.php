<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $test = User::all();
        dd($test);
        return view('site.pages.home');
    }

    public function category()
    {

        return view('site.pages.catelory');
    }

    public function product()
    {
        return view('site.pages.product');
    }

    public function cart()
    {
        return view('site.pages.product');
    }
}
