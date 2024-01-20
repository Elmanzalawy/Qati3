<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategories extends Component
{
    use WithPagination;

    const PER_PAGE = 15;

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.category.list-categories', [
            'categories' => Category::select('name', 'slug')->paginate(self::PER_PAGE),
        ]);
    }
}
