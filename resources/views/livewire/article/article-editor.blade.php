<div class="container pt-4">
    <div class="mb-3 d-flex align-items-center">
        <h2 class="text-dark d-inline-block">{{ $article->title ?? 'Add Article' }}
        </h2>
        @if($article && !$article->is_published)
            <span class="ms-2 badge text-bg-secondary">Draft</span>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group" wire:ignore>
                <textarea id="body" class="ckeditor form-control" wire:model.live="body" name="wysiwyg-editor"></textarea>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-dark pb-1 pt-2"><h6>Details</h6></div>
                <div class="card-body">
                    <x-input id="title" wire:model.live="title" name="title" type="text" text="Title" placeholder="Title"></x-input>
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input id="thumbnail" class="form-control" name="thumbnail" wire:model.live="thumbnail" type="file">
                        @if($thumbnail)
                            @if(get_class($thumbnail) == 'Livewire\Features\SupportFileUploads\TemporaryUploadedFile' && $thumbnail->exists())
                                <img class="w-100 mt-3" src="{{ $thumbnail->temporaryUrl() }}" alt="">
                            @else
                                <img class="w-100 mt-3" src="{{ $thumbnail->getRealPath() }}" alt="">
                            @endif
                        @elseif($article)
                            <img class="w-100 mt-3" src="{{ $article->thumbnail }}" alt="">
                        @endif
                        @error('thumbnail')
                        <ul>
                            @foreach ($errors->get('thumbnail') as $message)
                                <li class="is-invalid"><span class="text-danger">{{ $message }}</span></li>
                            @endforeach
                        </ul>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    @isset($article)
                        <button class="btn btn-primary" wire:loading.class='disabled' wire:click="updateArticle()">Publish</button>
                        <button class="btn btn-outline-primary" wire:loading.class='disabled' wire:click="updateArticle(false)">Save as Draft</button>
                    @else
                        <button class="btn btn-primary" wire:loading.class='disabled' wire:click="storeArticle()">Publish</button>
                        <button class="btn btn-outline-primary" wire:loading.class='disabled' wire:click="storeArticle(false)">Save as Draft</button>
                    @endisset
                 </div>
            </div>
        </div>
    </div>


    @pushonce('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <script>
            window.onload = (event) => {
                ClassicEditor
                .create(document.querySelector('#body'))
                .then(editor => {
                    const wordsPerMinute = 200;

                    editor.model.document.on('change:data', () => {
                        let data = editor.getData();
                        let wordCount = data.split(' ').length
                        const readTime = Math.ceil(wordCount / wordsPerMinute);

                        @this.set('body', data);
                        @this.set('read_time', readTime);
                    })
                })
                .catch(error => {
                    alert(error);
                });
            };
        </script>
    @endpushonce
</div>
