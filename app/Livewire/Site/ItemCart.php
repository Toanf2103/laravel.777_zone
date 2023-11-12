<?php

namespace App\Livewire\Site;

use App\Models\Product;
use Livewire\Component;

class ItemCart extends Component
{
    public $prod;
    public $quantity;
    public $check;
    public $idProd;

    
    

    public function render()
    {
        $this->prod = Product::where('id',$this->idProd)->first();
        
        return view('livewire.site.item-cart');
    }
}
