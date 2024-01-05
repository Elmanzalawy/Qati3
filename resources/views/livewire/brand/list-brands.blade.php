@section('css')
@vite(['resources/scss/brands.scss'])
@endsection
<div class="container pt-5">
    <h1 class="text-dark mb-4">{{ __('brand.brands') }}</h1>
    <div id="brands-filters-row" class=" d-flex flex-row justify-content-between my-2 mb-4">
        <span>
            <object class="icon-inactive" data="{{ asset('assets/icons/filter.svg') }}" type="image/svg+xml"></object>
        </span>
        <input class="form-control mx-3" type="text" wire:model.live.debounce.250ms='s' placeholder="Search">
        <span>
            <object data="{{ asset('assets/icons/grid.svg') }}" alt=""></object>
            <object data="{{ asset('assets/icons/list.svg') }}" alt=""></object>
        </span>
    </div>
    <div id="brands-wrapper" {{-- wire:ignore.self --}} class="row gy-5">
        @foreach ($brands as $brand)
        <x-brand.brand-card class="col-6 col-sm-6 col-md-3" :brand="$brand"></x-brand.brand-card>
        @endforeach
        <div id="end-of-brands-section-intersector"></div>
    </div>

    <script>
        let lastRecord = document.getElementById('end-of-brands-section-intersector');

        let observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                        @this.loadMore()
                    }
                });
           });
        observer.observe(lastRecord);
    </script>
</div>
