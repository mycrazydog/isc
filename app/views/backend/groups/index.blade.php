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

@if ($groups->count() >= 1) {{ $groups->links() }}

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

        @foreach ($groups as $group)
        <tr>
            <td><a href="{{ route('update/group', $group->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td>{{{ $group->name }}}</td>
            <td>{{{ $group->users()->count() }}}</td>
            <td>{{{ $group->created_at->diffForHumans() }}}</td>
            <td>
                <td><a href="{{ route('confirm-delete/group', $group->id) }}" data-toggle="modal" data-target="#delete_confirm"><span class="glyphicon glyphicon-trash"></span></a></td>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $groups->links() }}

@else
    @lang('general.noresults')
@endif
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
