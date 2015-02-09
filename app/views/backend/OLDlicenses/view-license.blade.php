@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
{{ $license->title }} ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')

@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')

@parent
@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')

@parent
@stop

{{-- Page content --}}
@section('content')
<h3>{{{ $license->id }}} --- {{{ $license->user_id }}}</h3>





<div>
    <span class="badge badge-info" title="{{{ $license->created_at }}}">
    @lang('license.licenseed')
    {{ $license->created_at->diffForHumans() }}</span>
</div>

<hr />





@stop
