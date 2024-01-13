<div class="container pt-4">
    @include('includes.messages')
    <div class="mb-3 d-flex align-items-center">
        <a href="{{ route('categories.index') }}">
            <h3 class="text-dark ">&larr; {{ __('category.categories') }}</h3>
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <x-input id='name_en' name='name_en' wire:model='name_en' type='text'
                                text="{{ __('category.name_en') }}" required>
                            </x-input>
                        </div>
                        <div class="col-12 col-sm-6">
                            <x-input id='name_ar' name='name_ar' wire:model='name_ar' type='text'
                                text="{{ __('category.name_ar') }}" required>
                            </x-input>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary" wire:loading.class='disabled' wire:click="save()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
