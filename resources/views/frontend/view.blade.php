@extends('frontend.single')

@section('title', __('Blog View'))

@section('content')
    <div class="album py-5 bg-light text-center">
        <div class="container">
            <h1>{{ $articles->title }}</h1>
            <img src="{{ url('/blog-image/'.$articles->article_image ) }}" alt="{{$articles->title}}" class="post-image pb-3" width="80%">
            <h3>{{ $articles->sub_title }}</h3>
            <div>
                {!! $articles->content !!}
            </div>
        </div>
        @if (isset($logged_in_user))
            <section class="content-item" id="comments">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 container">
                            <div id="form">
                                <input type="hidden" value="{{ $articles->id }}" id="articleId">
                                <h3 class="pull-left">New Comment</h3>
                                <button type="button" class="btn btn-info pull-right" id="btn-submit">Submit</button>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-3 col-lg-2 hidden-xs">
                                            <img class="img-responsive" src="{{ $logged_in_user->avatar }}" alt="">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                            <textarea class="form-control" id="message" placeholder="Your message" required=""></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <h3>{{ count($articles->comments) }} Comments</h3>
                            <div id="comment-area">
                                @foreach($articles->comments as $comment)
                                    <div class="media">
                                        <a class="pull-left" href="#"><img class="media-object" src="{{ $comment->users->avatar }}" alt=""></a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $comment->users->name }}</h4>
                                            <p>{{ $comment->content }}</p>
                                            <ul class="list-unstyled list-inline media-detail pull-left">
                                                <li><i class="fa fa-calendar"></i>{{ $comment->created_at }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
    @stack('before-scripts')
        @include('frontend.includes.single_js')
    @stack('after-scripts')
@endsection
