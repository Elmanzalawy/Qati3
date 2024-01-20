@section('css')

@endsection
<div class="container pt-3">
    <div class="d-flex align-items-center">
        <h2 class="text-dark">{{ __('category.categories') }}</h2>
        <a href="{{ route('categories.create') }}" class="ms-auto btn btn-outline-primary">{{ __('category.add') }}</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>@lang('category.name')</th>
                    <th>@lang('category.number_of_brands')</th>
                    <th>@lang('util.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ rand(0, 100) }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('categories.edit', ['slug' => $category->slug]) }}" wire:navigate>@lang('util.edit')</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
</div>
