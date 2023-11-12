<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $customers = User::where('role', 'customer')->orderBy('id', 'desc')->paginate(20);

        return view('admin.pages.customer.index', compact('customers'));
    }

    public function toggleStatus(User $customer)
    {
        if ($customer->status) {
            $dataUpdate = ['status' => 0];
            $message = 'Khóa tài khoản thành công!';
        } else {
            $dataUpdate = ['status' => 1];
            $message = 'Mở khóa tài khoản thành công!';
        }
        $customer->update($dataUpdate);

        return redirect()->route('admin.customers.index')->with('success', $message);
    }
}
