<?php

namespace App\View\Components\Site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     */
    public $listBanner;
    public function __construct($listBanner)
    {
        //
        $this->listBanner = $listBanner;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.site.slider');
    }
}
