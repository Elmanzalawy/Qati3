<div>
    <div class="form-group mb-3 {{ $attributes['class'] }}">
        <label for="{{ $attributes['id'] }}">{{ $attributes['label'] }}</label>
        <input id="{{ $attributes['id'] }}" class="form-control @error($attributes['name']) is-invalid @enderror"
            type="file" placeholder="{{ $attributes['placeholder'] ?? '' }}" {!! $attributes->merge() !!}>
        @error($attributes['name'])
        <ul>
            @foreach ($errors->get($attributes['name']) as $message)
            <li class="is-invalid"><span class="text-danger">{{ $message }}</span></li>
            @endforeach
        </ul>
        @enderror
    </div>

    @if($attributes['name'])
        @if(is_object($attributes['name']))
            @if(get_class($attributes['name']) == 'Livewire\Features\SupportFileUploads\TemporaryUploadedFile' && $attributes['name']->exists())
                <img class="w-100 mt-3" src="{{ $attributes['name']->temporaryUrl() }}" alt="">
            @else
            <img class="w-100 mt-3" src="{{ $attributes['name']->getRealPath() }}" alt="">
            @endif
        @endif
        @else
        <img class="w-100 mt-3" src="{{ $attributes['name'] }}" alt="">
    @endif
    @dump($attributes['name'])
</div>
