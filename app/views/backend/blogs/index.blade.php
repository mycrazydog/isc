@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/blogs/title.blogmanagement') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		@lang('admin/blogs/title.blogmanagement')

		<div class="pull-right">
			<a href="{{ route('create/blog') }}"><i class="icon-plus-sign icon-white"></i> @lang('button.create')</a>
		</div>
	</h3>
</div>

{{ $posts->links() }}

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th class="span1"></th>
			<th class="span6">@lang('admin/blogs/table.title')</th>
			<th class="span2">@lang('admin/blogs/table.comments')</th>
			<th class="span2">@lang('admin/blogs/table.created_at')</th>
			<th class="span1"></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($posts as $post)
		<tr>
			<td><a href="{{ route('update/blog', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td><a href="{{ $post->url() }}">{{ $post->title }}</a></td>
			<td>{{ $post->comments()->count() }}</td>
			<td>{{ $post->created_at->diffForHumans() }}</td>
			<td><a href="{{ route('delete/blog', $post->id) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $posts->links() }}
@stop
