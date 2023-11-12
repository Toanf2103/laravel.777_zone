<?php

namespace App\Livewire\Site;

use App\Models\Product;
use App\Services\Site\CartService;
use Livewire\Component;
use PDO;

class Cart extends Component
{
    public $cart;
    public $total;
    public $checkList = [];
    public $checkAll = false;

    public function incrementQuantity($id)
    {
        $cartSer = new CartService();

        if ($cartSer->updateQuantity($id, 1)) {
            $productCheck = array_search($id, array_column($this->cart, 'id'));
            $this->cart[$productCheck]['quantity'] += 1;
        } else {
            $this->dispatch('refresh');
        }
    }

    public function decrementQuantity($id)
    {
        $cartSer = new CartService();

        if ($cartSer->updateQuantity($id, -1)) {
            $productCheck = array_search($id, array_column($this->cart, 'id'));
            $this->cart[$productCheck]['quantity'] -= 1;
        } else {
            $this->dispatch('refresh');
        }
    }

    public function mount()
    {

        $cartSer = new CartService();

        $this->cart = $cartSer->getCart();

        // Duyệt qua mảng và thêm "check" vào mỗi mảng con
        foreach ($this->cart as $key => $item) {
            $this->cart[$key]['product'] = Product::where('id', $item['id'])->first();
        }
    }

    public function checkAllF()
    {
        if ($this->checkAll) {
            $this->checkList = array_map(function ($item) {
                return $item['id'];
            }, $this->cart);
        } else {
            $this->checkList = [];
        }
    }

    public function deleteProduct($id)
    {
        $cartSer = new CartService();

        $productCheck = array_search($id, array_column($this->cart, 'id'));
        if ($productCheck !== false && $cartSer->deleteProduct($id)) {
            unset($this->cart[$productCheck]);
            $this->cart = array_values($this->cart);

            $this->dispatch('alertDeleteProductToCart', [
                'count' => $cartSer->getCountCart()
            ]);
        } else {
            $this->dispatch('$referer');
        }
    }

    public function deleteListProduct()
    {
        $cartSer = new CartService();
        if (count($this->checkList) > 0 && $cartSer->deleteListProduct($this->checkList)) {

            // dd($this->checkList);
            foreach ($this->checkList as $id) {
                $productCheck = array_search($id, array_column($this->cart, 'id'));
                if ($productCheck !== false) {
                    unset($this->cart[$productCheck]);
                    $this->cart = array_values($this->cart);
                }
            }
            $this->checkList = [];
            $this->dispatch('alertDeleteProductToCart', [
                'count' => $cartSer->getCountCart()
            ]);
        }
    }

    public function render()
    {

        $this->total = 0;

        foreach ($this->checkList as $check) {
            $productCheck = array_search($check, array_column($this->cart, 'id'));
            if ($productCheck !== false) {

                $this->total += $this->cart[$productCheck]['quantity'] * $this->cart[$productCheck]['product']->price;
            }
        }

        return view('livewire.site.cart');
    }
}
