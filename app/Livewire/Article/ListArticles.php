<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ListArticles extends Component
{
    // use WithPagination;

    public $articles;


    public function mount()
    {
        $this->articles = Article::published()->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.article.list-articles');
    }
}
