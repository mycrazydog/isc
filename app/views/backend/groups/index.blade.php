@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('admin/groups/title.management') ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		@lang('admin/groups/title.management')

		<div class="pull-right">
			<a href="{{ route('create/group') }}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
		</div>
	</h3>
</div>

{{ $groups->links() }}

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th class="span1"></th>
			<th class="span6">@lang('admin/groups/table.name')</th>
			<th class="span2">@lang('admin/groups/table.users')</th>
			<th class="span2">@lang('admin/groups/table.created_at')</th>
			<th class="span1"></th>
		</tr>
	</thead>
	<tbody>
		@if ($groups->count() >= 1)
		@foreach ($groups as $group)
		<tr>
			<td><a href="{{ route('update/group', $group->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td>{{ $group->name }}</td>
			<td>{{ $group->users()->count() }}</td>
			<td>{{ $group->created_at->diffForHumans() }}</td>
			<td>
				<td><a href="{{ route('delete/group', $group->id) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
			</td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="5">@lang('general.noresults')</td>
		</tr>
		@endif
	</tbody>
</table>

{{ $groups->links() }}
@stop
