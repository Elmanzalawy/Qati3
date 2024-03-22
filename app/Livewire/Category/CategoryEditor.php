<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryEditor extends Component
{
    public $action = 'create';
    public $category;
    public $name_en;
    public $name_ar;

    public function rules()
    {
        return [
            'name_en' => [
                'required',
                'string',
                'min:2',
                Rule::unique('categories', "name->en")->when($this->category, function ($q) {
                    $q->ignore($this->category->id);
                }),
            ],
            'name_ar' => [
                'required',
                'string',
                'min:2',
                Rule::unique('categories', "name->ar")->when($this->category, function ($q) {
                    $q->ignore($this->category->id);
                }),
            ],
        ];
    }

    /**
     * mount
     *
     * @param  string|null $slug
     * @return void
     */
    public function mount($slug = null): void
    {
        if ($slug) {
            $this->category = Category::where('slug', $slug)->firstOrFail();

            $name = $this->category->getTranslations('name');
            $this->fill([
                'name_en' => $name['en'],
                'name_ar' => $name['ar'],
            ]);

            $this->action = 'update';
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.category.category-editor');
    }

    public function save(): void
    {
        try {
            $this->validate();
            if ($this->action == 'create') {
                $this->create();
            } else {
                $this->update();
            }

            redirect(route('categories.edit', $this->category->slug));
        } catch (ValidationException $e) {
            session()->flash('error', $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', __('util.error'));
            throw $e; // needs to be caught by global exception handler
        }
    }

    public function create(): void
    {
        $this->category = new Category([
            'slug' => Str::slug($this->name_en),
        ]);
        $this->category->setTranslations('name', [
            'en' => $this->name_en,
            'ar' => $this->name_ar,
        ])->save();


        session()->flash('success', __('category.added'));
    }

    public function update(): void
    {
        $this->category->slug = Str::slug($this->name_en);
        $this->category->setTranslations('name', [
            'en' => $this->name_en,
            'ar' => $this->name_ar,
        ])->save();

        session()->flash('success', __('category.updated'));
    }
}
