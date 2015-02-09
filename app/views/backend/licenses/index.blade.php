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


        <div class="pull-right">
            <a href="{{ route('create/license') }}" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>Create license</a>
        </div>

    </h3>
</div>



<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Requesting User</th>
            <th>Title</th>
            <th>IRB approved</th>
            <th>Data license request and investigator checklist submitted</th>
            <th>Reviewers' checklists completed</th>
            <th>DAROC vote approval</th>
            <th>DQRC established</th>
            <th>Data pulled</th>
            <th>DQRC meeting held</th>
            <th>Data given to investigator</th>
            <th>Project complete</th>
            <th>Created</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($licenses as $license)
        <tr>
            <td>
            @if(Sentry::getUser()->hasAccess('admin'))
            <a href="{{ route('update/license', $license->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
            @endif
            </td>
            <td>{{ Sentry::findUserById($license->user_id)->first_name  }} {{ Sentry::findUserById($license->user_id)->last_name }}</td>
            <td>{{ $license->title }}</td>
            <td>{{ $license->irb }}</td>
            <td>{{ $license->investigator }}</td>
            <td>{{ $license->reviewer }}</td>
            <td>{{ $license->vote }}</td>
            <td>{{ $license->establish }}</td>
            <td>{{ $license->data_extract }}</td>
            <td>{{ $license->meeting }}</td>
            <td>{{ $license->distribute }}</td>
            <td>{{ $license->complete }}</td>
            <td>{{{ $license->created_at->diffForHumans() }}}</td>
            <td>
            @if(Sentry::getUser()->hasAccess('admin'))
            <a href="{{ route('confirm-delete/license', $license->id) }}" data-toggle="modal" data-target="#delete_confirm"><span class="glyphicon glyphicon-trash"></span></a>
            @endif
            </td>            
        </tr>
        <tr>
        	<td colspan="14">Notes: <br/>{{ $license->notes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


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
