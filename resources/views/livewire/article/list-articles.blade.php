@section('css')
    @vite(['resources/scss/articles.scss'])
@endsection
<div class="container pt-5">
    <h1 class="text-dark mb-4">Latest Articles</h1>
    <div id="articles-wrapper" class="row gy-5">
        @foreach ($articles as $article)
            <div class="article-list-card col-12 col-sm-6 col-md-3">
                <img src="{{ $article->thumbnail }}" alt="" class="w-100">
                <a href="{{ route('articles.show', $article->slug) }}">
                    <h5 class="bold text-dark my-3">{{ $article->title }}</h5>
                </a>
                <div class="text-muted article-footer d-flex justify-content-between mt-3">
                    <span>{{ date('M d, Y', strtotime($article->created_at)) }}</span>
                    <span><i class="fas fa-stopwatch -2"></i> {{ $article->read_time }} minutes</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
