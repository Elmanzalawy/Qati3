<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BrandEditor extends Component
{
    use WithFileUploads;

    public $lang = 'en';

    public $brand;

    public $name;

    public $description;

    public $is_visible;

    public $boycott_status;

    public $boycott_status_list;

    public $established_at;

    public $logo;

    protected $rules = [
        'name' => 'required|string|min:2|unique:brands,name',
        'description' => 'required|string|min:10',
        'is_visible' => 'nullable|boolean',
        'boycott_status' => 'required|numeric',
        'logo' => 'required|image|max:1024',
        'established_at' => 'required|date',
    ];

    /**
     * mount
     *
     * @param  string|null $slug
     * @return void
     */
    public function mount($slug = null): void
    {
        $this->boycott_status_list = Brand::BOYCOTT_STATUSES;

        if($slug){
            $this->brand = Brand::where('slug', $slug)->firstOrFail();
            $this->name = $this->brand->name;
            $this->description = $this->brand->description;
            $this->boycott_status = $this->brand->boycott_status;
            $this->established_at = $this->brand->established_at;
            $this->is_visible = (bool) $this->brand->is_visible;
        }
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.brand.brand-editor');
    }

    public function save(): void
    {
        try{
            info($this->established_at);
            $this->validate();
            $brand = new Brand([
                'slug' => Str::slug($this->name),
                'boycott_status' => $this->boycott_status,
                'established_at' => $this->established_at,
            ]);
            $brand->setTranslations('name', [
                $this->lang => $this->name,
            ])->setTranslations('description', [
                $this->lang => $this->description,
            ])->save();

            session()->flash('success', __('brand.added'));
            redirect(route('brands.edit', $brand->slug));
        }
        catch(ValidationException $e){
            session()->flash('error', $e->getMessage());
            throw $e;
        }
        catch(\Exception $e){
            session()->flash('error', __('util.error'));
            throw $e; // needs to be caught by global exception handler
        }
    }
}
