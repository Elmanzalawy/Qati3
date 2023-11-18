<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule as ValidationRule;

class ArticleEditor extends Component
{
    use WithFileUploads;

    public $article;

    public $title;

    public $body;

    public $read_time;

    public $thumbnail;

    public function mount($slug = null)
    {
        if($slug){
            $this->article = Article::where('slug', $slug)->firstOrFail();
            $this->title = $this->article->title;
            $this->body = $this->article->body;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        info($this->read_time);
        return view('livewire.article.article-editor');
    }

    public function storeArticle($publish = true)
    {
        $this->validate([
            'title' => 'string|required|min:10|unique:articles,title',
            'body' => 'string|required|min:10',
            'read_time' => 'required|numeric',
            'thumbnail' => 'image|required|max:1024',
        ]);

        $this->article = Article::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'body' => $this->body,
            'is_published' => $publish,
            'author_id' => auth()->id(),
        ]);

        $this->article->addMedia($this->thumbnail)
            ->toMediaCollection();

        $this->redirect(route('articles.index'), navigate:true);
    }

    public function updateArticle($publish = true)
    {
        $this->validate([
            'title' => [
                'string',
                'required',
                'min:10',
                ValidationRule::unique('articles')->ignore($this->article->id),
            ],
            'body' => 'string|required|min:10',
            'read_time' => 'required|numeric',
            'thumbnail' => 'nullable|image|max:1024',
        ]);

        $this->article->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'body' => $this->body,
            'read_time' => $this->read_time,
            'is_published' => $publish,
            'author_id' => auth()->id(),
        ]);

        if($this->thumbnail){
            $this->article->clearMediaCollection()
                ->addMedia($this->thumbnail)
                ->toMediaCollection();
        }

        $this->redirect(route('articles.index'), navigate:true);
    }
}
