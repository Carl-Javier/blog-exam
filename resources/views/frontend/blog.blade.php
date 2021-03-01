@extends('frontend.index')

@section('title', __('Blog'))

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($articles as $article)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" alt="Thumbnail [100%x225]" src="{{ url('/blog-image/'.$article->article_image ) }}" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                            <div class="card-body">
                                <h3>{{ $article->title }}</h3>
                                <p class="card-text">{{ $article->sub_title }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('frontend.single', ['id' => $article->id]) }}" class="btn btn-sm btn-outline-secondary">Read more</a>
                                    </div>
                                    <small class="text-muted">{{ $article->published_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
