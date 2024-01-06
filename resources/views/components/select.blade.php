<div {{ $attributes['class'] }}>
    <label for="logo" class="form-label">{{ $attributes['label'] }}</label>
    <select id="{{ $attributes['id'] }}" class="form-select @error($attributes['name']) is-invalid @enderror" {!! $attributes->merge() !!}>
        {{ $slot }}
    </select>
    @error($attributes['name'])
    <ul>
        @foreach ($errors->get($attributes['name']) as $message)
            <li class="is-invalid"><span class="text-danger">{{ $message }}</span></li>
        @endforeach
    </ul>
    @enderror
</div>
