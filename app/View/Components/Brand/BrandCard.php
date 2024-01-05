<?php

namespace App\View\Components\Brand;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BrandCard extends Component
{
    public $brand;

    /**
     * Create a new component instance.
     */
    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.brand.brand-card');
    }
}
