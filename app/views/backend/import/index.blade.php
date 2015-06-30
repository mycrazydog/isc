@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Manage imports ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        Manage imports

        <div class="pull-right">
            <a href="{{ route('create/import') }}" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> New import</a>
        </div>
    </h3>
</div>



<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="span1">Batch Id</th>
            <th class="span1">Depositor</th>
            <th class="span6">Description</th>
            <th class="span2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($importlogs as $importlog)
        <tr>
            <td>{{ $importlog->id }}</a></td>
            <td>{{ Post::find($importlog->partner_id)->title }}</a></td>
            <td>{{{ $importlog->batch_description }}}</td>
            <td><a href="{{ route('confirm-delete/import', $importlog->id) }}"" data-toggle="modal" data-target="#delete_confirm"><span class="glyphicon glyphicon-trash"></span></a></td>
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
