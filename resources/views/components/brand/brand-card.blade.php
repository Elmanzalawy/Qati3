<div class="brand-card {{ $attributes['class'] }}">
    <a href="{{ route('brands.show', $brand->slug) }}">
        <div class="logo-wrapper">
            <img src="{{ $brand->logo }}" alt="" class="w-100">
            <x-boycott-status-pill :brand="$brand"></x-boycott-status-pill>
        </div>
        <div class="brand-card-header d-flex justify-content-between align-items-center">
            <h5 class="bold text-dark mt-2">{{ $brand->name }}</h5>
            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="tooltip"></i>
        </div>

    </a>
    <div class="text-muted brand-footer d-flex justify-content-between">
    </div>
</div>
