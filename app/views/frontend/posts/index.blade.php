@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
@if (count($posts))
@foreach ($posts as $post)
<div class="row">
    <div class="span8">

        <!-- Post Content -->

        <div class="media">
          <a class="pull-left" href="{{{ $post->url() }}}">
          @if ($post->thumbnail())
            <img class="media-object" src="{{{ $post->thumbnail() }}}." alt="...">
          @endif
          </a>
          <div class="media-body">
            <h4 class="media-heading"><a href="{{{ $post->url() }}}">{{{ $post->title }}}</a></h4>
            {{{ Str::limit($post->content, 200) }}}
          </div>
          <div class="media-footer">
                <p></p>
                <p>
                    <i class="icon-user"></i> by
                    @if ($post->author) {{{ $post->author->first_name }}}
                     @else
                        discontinued user
                     @endif
                    | <i class="icon-calendar"></i> {{{ $post->created_at->diffForHumans() }}}
                    | <i class="icon-comment"></i> <a href="{{ $post->url() }}#comments">Comments
                    <span class="badge">{{ $post->comments()->count() }}</span></a>
                </p>
            </div>
        </div>

    </div>
</div>

<hr />
@endforeach

{{ $posts->links() }}

@else
<h1>Oops. That page number is invalid.</h1>
@endif
@stop
