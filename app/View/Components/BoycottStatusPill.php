<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BoycottStatusPill extends Component
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
        return view('components.boycott-status-pill');
    }
}
