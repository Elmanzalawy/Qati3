<div class="form-floating mb-3 {{ $attributes['class'] }}">
    <input id="{{ $attributes['id'] }}" class="form-control @error($attributes['name']) is-invalid @enderror" {!! $attributes->merge() !!}>
    <label for="{{ $attributes['id'] }}">{{ $attributes['text'] }}</label>
    @error($attributes['name'])
    <ul>
        @foreach ($errors->get($attributes['name']) as $message)
            <li class="is-invalid"><span class="text-danger">{{ $message }}</span></li>
        @endforeach
    </ul>
    @enderror
</div>
