<div>
    <div class="form-check {{ $attributes['class'] }}">
        <input id="{{ $attributes['id'] }}" class="form-check-input @error($attributes['name']) is-invalid @enderror"
            type="checkbox" {!! $attributes->merge() !!}>
        <label class="form-check-label" for="{{ $attributes['id'] }}">{{ $attributes['text'] }}</label>
    </div>
    @error($attributes['name'])
        <ul>
            @foreach ($errors->get($attributes['name']) as $message)
            <li class="invalid-feedbackd"><span class="text-danger">{{ $message }}</span></li>
            @endforeach
        </ul>
        @enderror
</div>
