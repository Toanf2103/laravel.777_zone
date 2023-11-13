<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AddressService;

class CustomerController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->middleware('admin');

        $this->addressService = $addressService;
    }

    public function index()
    {
        $customers = User::where('role', 'customer')->orderBy('id', 'desc')->paginate(20);

        foreach ($customers as $index => $customer) {
            $address = $this->addressService->getDetailByWardId($customer->ward_id);
            $customers[$index]['full_address'] = "{$customer->address}, {$address['districts']['wards']['name']}, {$address['districts']['name']}, {$address['name']}";
        }

        return view('admin.pages.customer.index', compact('customers'));
    }

    public function toggleStatus(User $customer)
    {
        if ($customer->role != 'customer') {
            return redirect()->back()->with('error', 'Bạn không có quyền thực hiện hành động này');
        }

        if ($customer->status) {
            $dataUpdate = ['status' => 0];
            $message = 'Khóa tài khoản thành công!';
        } else {
            $dataUpdate = ['status' => 1];
            $message = 'Mở khóa tài khoản thành công!';
        }
        $customer->update($dataUpdate);

        return redirect()->back()->with('success', $message);
    }
}
