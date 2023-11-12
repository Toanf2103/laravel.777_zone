<?php

namespace App\View\Components\Site;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SliderProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public $category;
    public $products;


    public function __construct($category)
    {
        //
        $this->category = $category;
    
        // $this->products = $this->category->brandCategories->products->take(8)->get();
        $this->products = Product::whereHas('brandCategory', function($query) use ($category) {
            return $query->where('category_id',$category->id);
        })->take(8)->get();

        // dd($this->products);

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.site.slider-product');
    }
}
