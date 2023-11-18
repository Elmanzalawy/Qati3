@section('css')
@vite(['resources/scss/articles.scss'])
@endsection
<div class="container py-4">
    <h1 class="bold mb-3">{{ $article->title }}</h1>
    <div id="author-details" class="my-4 d-flex align-items-center">
        <img src="https://via.placeholder.com/150" alt="">
        <div class="ms-3 d-flex flex-column">
            <small class="bold">{{ $article->author->name }}</small>
            <small class="text-muted">{{ $article->read_time }} min read <b>.</b> {{ date('M y',
                strtotime($article->created_at)) }}</small>
        </div>
    </div>
    <hr>
    {!! $article->body !!}
</div>
