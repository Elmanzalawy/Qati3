<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewArticle extends Component
{
    public $article;

    public function mount($slug)
    {
        if($slug){
            $this->article = Article::where('slug', $slug)->firstOrFail();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.article.view-article');
    }
}
