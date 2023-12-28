<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BrandEditor extends Component
{
    use WithFileUploads;

    public $action = 'create';

    public $lang = 'en';

    public $brand;

    public $name;

    public $description;

    public $is_visible;

    public $boycott_status;

    public $boycott_status_list;

    public $parent_brand_id;

    public $brandsList;

    public $established_at;

    public $logo;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                Rule::unique('brands', "name->{$this->lang}")->when($this->brand, function($q){
                    $q->ignore($this->brand->id);
                }),
            ],
            'description' => 'required|string|min:10',
            'is_visible' => 'nullable|boolean',
            'boycott_status' => 'required|numeric',
            'logo' => [
                Rule::requiredIf(!$this->brand),
                'nullable',
                'image',
                'max:1024',
            ],
            'parent_brand_id' => 'nullable|numeric',
            'established_at' => 'required|date',
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
        $this->boycott_status_list = Brand::BOYCOTT_STATUSES;
        $this->brandsList = Brand::select('id', "name")->get();

        if($slug){
            $this->brand = Brand::where('slug', $slug)->firstOrFail();

            $this->fill(
                $this->brand->only(
                    'name',
                    'description',
                    'boycott_status',
                    'parent_brand_id',
                    'established_at',
                    'is_visible',
                ),
            );

            $this->action = 'update';
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
            $this->validate();
            if($this->action == 'create'){
                $this->create();
            }else{
                $this->update();
            }

            redirect(route('brands.edit', $this->brand->slug));
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

    public function create(): void
    {
        $this->brand = new Brand([
            'slug' => Str::slug($this->name),
            'boycott_status' => $this->boycott_status,
            'is_visible' => $this->is_visible,
            'established_at' => $this->established_at,
        ]);
        $this->brand->setTranslations('name', [
            $this->lang => $this->name,
        ])->setTranslations('description', [
            $this->lang => $this->description,
        ])->save();

        $this->brand->addMedia($this->logo)->toMediaCollection();

        session()->flash('success', __('brand.added'));
    }

    public function update(): void
    {
        $this->brand->slug = Str::slug($this->name);
        $this->brand->boycott_status = $this->boycott_status;
        $this->brand->is_visible = $this->is_visible;
        $this->brand->established_at = $this->established_at;
        $this->brand->setTranslations('name', [
                $this->lang => $this->name,
            ])->setTranslations('description', [
                $this->lang => $this->description,
            ])->save();


        if($this->logo){
            // Replace old logo with new logo
            $this->brand->clearMediaCollection()->addMedia($this->logo)->toMediaCollection();
        }
        session()->flash('success', __('brand.updated'));
    }
}
