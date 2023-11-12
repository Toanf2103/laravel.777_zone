<?php

namespace App\Livewire\Site;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class HeaderSearch extends Component
{
    
    public function render()
    {
        $quantityRsHistory = 5;

        $listKeySearch = Session::get('historyKeySearchs') ?? [];

        $listKeySearch = array_reverse($listKeySearch);

        $listKeySearch = array_slice($listKeySearch, 0, $quantityRsHistory);

        return view('livewire.site.header-search',compact('listKeySearch'));
    }
}
