<div class="container pt-4">
    @include('includes.messages')
    <div class="mb-3 d-flex align-items-center">
        <h2 class="text-dark d-inline-block">{{ $brand->name ?? 'Add new brand' }}
        </h2>
        @if($brand && !$brand->is_visible)
            <span class="ms-2 badge text-bg-secondary">Draft</span>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <x-input id='name' name='name' wire:model='name' type='text' text="{{ __('brand.name') }}" required></x-input>
                        </div>
                        <div class="col-12 col-sm-6">
                            <x-input id='established_at' wire:model='established_at' name='established_at' type='date' text="{{ __('brand.established_at') }}" required></x-input>
                        </div>
                        <div class="col-12">
                            <hr>
                            <div class="form-group" wire:ignore>
                                <h5 class="mb-3">{{ __('brand.description') }}</h5>
                                <textarea id="description" class="ckeditor form-control" wire:model.live="description" name="wysiwyg-editor"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mt-3 mt-sm-0">
            <div class="card">
                <div class="card-header text-dark pb-1 pt-2">
                    <h6>Details</h6>
                </div>
                <div class="card-body">
                    <div class="my-2">
                        <x-select id='boycott_status' wire:model='boycott_status' name='boycott_status' label="{{ __('brand.boycott_status') }}" required>
                            <option value="" class="text-muted">Select status..</option>
                            @foreach ($boycott_status_list as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="my-2">
                        <x-select id='parent-brand-id' wire:model='parent_brand_id' name='parent_brand_id' label="{{ __('brand.parent_brand') }}" required>
                            <option value="" class="text-muted">Select parent brand..</option>
                            @foreach ($brandsList as $brandEntry)
                                <option value="{{ $brandEntry->id }}">{{ $brandEntry->name}}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="my-2">
                        {{-- <x-file-input name="logo" wire:model.live="logo"></x-file-input> --}}
                        <label for="logo" class="form-label">Logo</label>
                        <input id="logo" class="form-control @error('logo') is-invalid @enderror" name="logo" wire:model.live="logo" type="file">
                        @if($logo)
                            @if(get_class($logo) == 'Livewire\Features\SupportFileUploads\TemporaryUploadedFile' && $logo->exists())
                                <img class="w-100 mt-3" src="{{ $logo->temporaryUrl() }}" alt="">
                            @else
                                <img class="w-100 mt-3" src="{{ $logo->getRealPath() }}" alt="">
                            @endif
                        @elseif($brand)
                            <img class="w-100 mt-3" src="{{ $brand->logo }}" alt="">
                        @endif
                        @error('logo')
                        <ul>
                            @foreach ($errors->get('logo') as $message)
                                <li class="is-invalid"><span class="text-danger">{{ $message }}</span></li>
                            @endforeach
                        </ul>
                        @enderror
                    </div>
                    <x-checkbox class="form-switch checkbox-lg mt-3" wire:model="is_visible" name="is_visible" id="flexSwitchCheckChecked" text="{{ __('brand.visible') }}"></x-checkbox>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-primary" wire:loading.class='disabled' wire:click="save()">Save</button>
                 </div>
            </div>
        </div>
    </div>


    @pushonce('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <script>
            window.onload = (event) => {
                ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    const wordsPerMinute = 200;

                    editor.model.document.on('change:data', () => {
                        let data = editor.getData();
                        @this.set('description', data);
                    })
                })
                .catch(error => {
                    alert(error);
                });
            };
        </script>
    @endpushonce
</div>
