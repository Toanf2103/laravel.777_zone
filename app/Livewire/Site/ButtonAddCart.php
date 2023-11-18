<?php

namespace App\Livewire\Site;

use App\Services\Site\CartService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ButtonAddCart extends Component
{
    public $product;

    protected $carServ;

    public function addToCart()
    {
        $carServ = new CartService();
        // $carServ->destroyCart();

        $checkAdd = $carServ->addProduct($this->product);
        // dd($checkAdd);
        if ($checkAdd) {
            // dd(1);
            $this->dispatch('alertProductToCart', [
                'productAdd' => $this->product->name,
                'count' => $carServ->getCountCart()
            ]);
        }
        // dd($carServ->getCart());
        // return;
    }


    public function render()
    {
        
        return view('livewire.site.button-add-cart');
    }
}
