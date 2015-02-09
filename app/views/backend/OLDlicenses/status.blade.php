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
        License Request Status
    </h3>
</div>

{{ $licenses->links() }}

<table class="table table-striped table-hover">
    <thead>
        <tr>

            <th class="span6">Requesting User</th>
            <th class="span2">License status</th>
            <th class="span4">@lang('admin/licenses/table.created_at')</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($licenses as $license)
        <tr>

            <td>{{ Sentry::findUserById($license->user_id)->first_name  }} {{ Sentry::findUserById($license->user_id)->last_name }}</td>
            <td>{{ $license->licensestatus }}</td>
            <td>{{{ $license->created_at->diffForHumans() }}}</td>

        </tr>
        @endforeach
    </tbody>
</table>

{{ $licenses->links() }}
@stop
