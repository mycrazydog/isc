@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.blogmanagement') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        @lang('admin/posts/title.blogmanagement')

        <div class="pull-right">
            <!--<a href="{{ route('create/post') }}" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>-->
        </div>
    </h3>
</div>

{{ $posts->links() }}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">@lang('admin/posts/table.title')</th>
            <!--<th class="span1"><i class="fa fa-comments"></i></th>-->
            <th class="span2">@lang('admin/posts/table.created_at')</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td><a href="{{ route('update/post', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="{{ $post->url() }}">{{ $post->title }}</a></td>
            <!--<td>{{{ $post->comments()->count() }}}</td>-->
            <td>{{{ $post->created_at->diffForHumans() }}}</td>
            <td><a href="{{ route('confirm-delete/post', $post->id) }}" data-toggle="modal" data-target="#delete_confirm"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="row">
	<div class="col-lg-12">
		<h3>Create New depositor</h3>
		{{ Form::open(array('url' => 'admin/posts/create', 'method' => 'post', 'class'=>'form-horizontal')) }}
			<!-- CSRF Token -->
			{{ Form::token() }}
			<!-- Post Title -->
			<div class="form-group {{ $errors->first('title', 'has-error') }}">
			    <label for="title" class="col-sm-1 control-label">@lang('admin/posts/form.posttitle')</label>
			    <div class="col-sm-4">
			    	{{ Form::text('title', null, ['class' => 'form-control']) }}
			    </div>
			    <div class="col-sm-4">
			        {{ $errors->first('title', '<span class="help-block">:message</span>') }}
			    </div>
			</div>
			<!-- Form Actions -->
			<div class="form-group">
			  <div class="col-sm-3">
			    <button type="submit" class="btn btn-default">Create</button>
			  </div>
			</div>
		{{ Form::close() }}
	</div>
</div>






{{ $posts->links() }}
@stop

{{-- Body Bottom confirm modal --}}
@section('body_bottom')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop
