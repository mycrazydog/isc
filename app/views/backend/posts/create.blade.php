@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.create') ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="page-header">
    <h3>
        @lang('admin/posts/title.create')

        <div class="pull-right">
            <a href="{{ route('posts') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
        </div>
    </h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab">@lang('admin/posts/form.general')</a></li>
    <li><a href="#tab-meta-data" data-toggle="tab">@lang('admin/posts/form.metadata')</a></li>
</ul>

{{ Form::open(['files'=> true]) }}
	<!-- CSRF Token -->
	{{ Form::token() }}
	
	@include('backend/posts/partials/_form')

{{ Form::close() }}


@stop
