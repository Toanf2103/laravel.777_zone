<?php

namespace App\Services\Site;

use App\Models\Brand;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Session;

class CartService
{

    public function getCart()
    {
        $cart = Session::get('cart') ?? [];
        $this->checkCart($cart);
        return $cart;
    }

    public function addProduct($product)
    {
        $cart = $this->getCart();
        // Tìm xem sản phẩm có tồn tại trong giỏ hàng không
        $productCheck = array_search($product->id, array_column($cart, 'id'));

        if ($productCheck === false) {
            $cart[] = [
                'id' => $product->id,
                'quantity' => 1
            ];
        } else {
            $cart[$productCheck]['quantity'] += 1;
        }

        Session::put('cart', $cart);
        Session::save();
        return true;
    }

    public function deleteProduct($id)
    {
        $cart = $this->getCart();
        $productCheck = array_search($id, array_column($cart, 'id'));
        if ($productCheck !== false) {
            unset($cart[$productCheck]);
            $cart = array_values($cart);
            Session::put('cart', $cart);
            Session::save();
            return true;
        }
        return false;
    }

    public function deleteListProduct($listId)
    {
        $cart = $this->getCart();
        foreach ($listId as $id) {
            $productCheck = array_search($id, array_column($cart, 'id'));

            if ($productCheck !== false) {
                unset($cart[$productCheck]);
                $cart = array_values($cart);
            }
        }
        Session::put('cart', $cart);
        Session::save();
        return true;

    }

    public function destroyCart()
    {
        Session::forget('cart');
        Session::save(); // Save the changes immediately
        return true;
    }

    public function updateQuantity($id, $value)
    {
        $cart = $this->getCart();
        $productCheck = array_search($id, array_column($cart, 'id'));
        if ($productCheck !== null && $cart[$productCheck]['quantity'] + $value > 0) {
            $cart[$productCheck]['quantity'] += $value;
            Session::put('cart', $cart);
            Session::save();
            return true;
        }
        return false;

        // dd(Session::get('cart'));

    }

    public function getCountCart()
    {
        return count($this->getCart());
    }

    public function checkCart($cart)
    {
        $check = false;
        foreach ($cart as $key => $item) {
            if (Product::where('id', $item['id'])->where('status', false)->first()) {
                $check = true;
                unset($cart[$key]);
            }
        }
        // Làm mới chỉ mục mảng sau khi loại bỏ phần tử
        if ($check === false) {
            return true;
        } else {
            $cart = array_values($cart);
            Session::put('cart', $cart);
            Session::save();
            return false;
        }
    }

    public function getQuatityProduct($id) {
        $cart = $this->getCart();
        $productCheck = array_search($id, array_column($cart, 'id'));
        if($productCheck !==false){
            return $cart[$productCheck]['quantity'];
        }
        return false;

    }
}
