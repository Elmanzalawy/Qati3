<div id="recently-added-brands">
    @cache('recently-added-brands')
        <h3 class="text-dark">Recently added</h3>
        @foreach ($brands as $brand)
        <x-brand.brand-card class="my-4" :brand="$brand"></x-brand.brand-card>
        @endforeach
    @endcache
</div>
