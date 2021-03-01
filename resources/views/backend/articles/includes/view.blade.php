<div class="text-center">
    <h2 class="post-title">
        <a href="#">{{$article->title}}</a>
    </h2>
    <div class="post-date">
        {{$article->published_at}}
    </div>
    <br>
    <img src="{{ url('/blog-image/'.$article->article_image ) }}" alt="{{$article->title}}" class="post-image pb-3">
    <div class=" post-content">
        {!! $article->content !!}
    </div>
</div>
