<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ListBrands extends Component
{
    use WithPagination;

    const PER_PAGE = 15;
    public $page = 1;
    public $brands = [];

    #[Url]
    public $s = '';


    public function mount()
    {
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->getBrandsPaginated();
        return view('livewire.brand.list-brands');
    }

    public function updatedS()
    {
        $this->brands = [];
        $this->page = 1;
    }

    public function getBrandsPaginated()
    {
        array_push($this->brands, ...Brand::select('id', 'name', 'slug', 'boycott_status')
            ->visible()
            ->when($this->s, function($q){
                $q->where('name', 'LIKE', "%{$this->s}%");
            })
            ->skip($this->page - 1)
            ->take(self::PER_PAGE)
            ->get(['id', 'name', 'slug', 'boycott_status']));
    }

    public function loadMore()
    {
        $this->page++;
    }
}
