<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
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
        'is_visible' => 'required|boolean',
        'boycott_status' => 'required|numeric',
        'logo' => 'required|image|max:1024',
        'established_at' => 'required|date',
    ];

    public function mount($slug = null)
    {
        $this->boycott_status_list = Brand::BOYCOTT_STATUSES;

        if($slug){
            $this->brand = Brand::where('slug', $slug)->firstOrFail();
            $this->name = $this->brand->name;
            $this->description = $this->brand->description;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.brand.brand-editor');
    }

    public function save()
    {
        info('saving');
        info(json_encode($this->all()));
        try{
            $this->validate();
        }
        catch(ValidationException $e){
            info($e->getMessage());
        }

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
    }
}
