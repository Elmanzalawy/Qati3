<?php

namespace App\Livewire\Category;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ListCategories extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.category.list-categories');
    }
}
