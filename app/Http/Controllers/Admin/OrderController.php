<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\AddressService;

class OrderController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->middleware('admin');

        $this->addressService = $addressService;
    }

    public function index(Request $request)
    {
        $payMethod = $request->input('pay_method');
        $payStatus = $request->input('pay_status');
        $status = $request->input('status');

        $orders = Order::query();

        if ($payMethod != null) {
            $orders = $orders->where('pay_method', $payMethod);
        }
        if ($payStatus != null) {
            $orders = $orders->where('pay_status', $payStatus);
        }
        if ($status != null) {
            $orders = $orders->where('status', $status);
        }

        $orders = $orders->orderBy('id', 'desc')->paginate(20);

        return view('admin.pages.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $address = $this->addressService->getDetailByWardId($order->ward_id);
        $order['full_address'] = "{$order->address}, {$address['districts']['wards']['name']}, {$address['districts']['name']}, {$address['name']}";

        return view('admin.pages.order.show', compact('order'));
    }

    public function changeStatus(Order $order, $status)
    {
        $order->status = $status;

        if ($status == 'completed') {
            $order->pay_status = 1;
        }

        $order->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin đơn hàng thành công');
    }
}
