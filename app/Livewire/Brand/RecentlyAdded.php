<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Livewire\Component;

class RecentlyAdded extends Component
{
    public $brands;

    public function mount(){
        $this->brands = Brand::visible()
            ->orderBy('id', 'desc')
            ->take(3)->get();
    }

    public function render()
    {
        return view('livewire.brand.recently-added');
    }
}
