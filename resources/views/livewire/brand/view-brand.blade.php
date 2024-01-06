@section('css')
@vite(['resources/scss/brands.scss'])
@endsection
<div class="container pt-4">
    <a href="{{ route('brands.index') }}">
        <h3 class="text-dark mb-4">&larr; Brands</h3>
    </a>

    <div class="row">
        <div class="col-12 col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <img src="{{ $brand->logo }}" alt="">
                        </div>
                        <div class="col d-flex flex-column">
                            <h1 class="text-dark mb-4">{{ $brand->name }}</h1>
                            @if($brand->parent_brand_id)
                                <h5 class="my-3 text-muted">{{ __('brand.subsidiary_of') }}
                                    <a href="{{ route('brands.show', $brand->parent->slug) }}">{{ $brand->parent->name }}</a>
                                </h5>
                            @endif
                            <x-boycott-status-pill :brand="$brand"></x-boycott-status-pill>
                            @if($brand->established_at)
                                <p class="mt-auto text-muted">{{ __('brand.established_on', ['date' => $brand->establishment_year]) }}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div id="brand-description-wrapper" class="my-3">
                        <h4>Description</h4>
                        {!! $brand->description !!}
                    </div>

                    @if($brand->hasSubsidiaries())
                    <div id="subsidiaries-wrapper">
                        <h4 class="text-dark">{{ __('brand.subsidiaries') }}</h4>
                        @foreach ($brand->subsidiaries as $subsidiary)
                            <x-brand.brand-card class="mx-3" :brand="$subsidiary"></x-brand.brand-card>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div id="brand-aside-section" class="mt-4 mt-sm-0 col-12 col-md-3">
            @livewire('brand.recently-added')
        </div>
    </div>
</div>