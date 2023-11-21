<?php

namespace App\Services\Site;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderService
{

    public function create($params, $listProduct)
    {
        $userId = null;
        if (Auth::guard('user')->check()) {
            $userId = Auth::guard('user')->user()->id;
        }
        $order = Order::create([
            'user_id' => $userId,
            'name' => $params['username'],
            'phone_number' => $params['phone-number'],
            'email' => $params['email'],
            'province_id' => $params['province'],
            'district_id' => $params['district'],
            'ward_id' => $params['ward'],
            'address' => $params['address-user'],
            'pay_method' => $params['type-pay'],
            'status' => 'creating',
            'ship_fee' => 30000
        ]);
        // dd($listProduct);
        foreach ($listProduct as $product) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $product->quantityCart,
                'price' => $product->price
            ]);
        }
        // dd($order);
        return $order;
    }
    public function getOrderById($id){
        return Order::where('id', $id)->first();
    }
}
