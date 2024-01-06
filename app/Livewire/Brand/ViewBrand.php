<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewBrand extends Component
{
    public $brand;

    public function mount($slug)
    {
        $this->brand = Brand::findBySlug($slug);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.brand.view-brand');
    }
}
