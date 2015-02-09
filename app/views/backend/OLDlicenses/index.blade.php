@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/licenses/title.blogmanagement') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        Manage Licenses


        <!--<div class="pull-right">
            <a href="{{ route('create/license') }}" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>Create license</a>
        </div>-->

    </h3>
</div>

{{ $licenses->links() }}

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1"></th>
            <th class="span6">Requesting User</th>
            <th class="span1">License status</th>
            <th class="span2">@lang('admin/licenses/table.created_at')</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($licenses as $license)
        <tr>
            <td><a href="{{ route('update/license', $license->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td>{{ Sentry::findUserById($license->user_id)->first_name  }} {{ Sentry::findUserById($license->user_id)->last_name }}</td>
            <td>{{ $license->licensestatus }}</td>
            <td>{{{ $license->created_at->diffForHumans() }}}</td>
            <td><a href="{{ route('confirm-delete/license', $license->id) }}" data-toggle="modal" data-target="#delete_confirm"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $licenses->links() }}
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
