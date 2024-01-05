<div class="boycott-status-pill {{ $attributes['class'] }}" {{ $attributes->merge()->except(['class']) }}>
    @switch($brand->boycott_status_string)
        @case($brand::BOYCOTT_STATUS_UNKNOWN)
            <span class="badge rounded-pill bg-secondary">{{ $brand->boycott_status_string }}</span>
            @break
        @case($brand::BOYCOTT_STATUS_NEUTRAL)
            <span class="badge rounded-pill bg-warning">{{ $brand->boycott_status_string }}</span>
            @break
        @case($brand::BOYCOTT_STATUS_SUPPORTED)
            <span class="badge rounded-pill bg-success">{{ $brand->boycott_status_string }}</span>
            @break
        @case($brand::BOYCOTT_STATUS_BOYCOTTED)
            <span class="badge rounded-pill bg-danger">{{ $brand->boycott_status_string }}</span>
            @break
        @default
    @endswitch
</div>
