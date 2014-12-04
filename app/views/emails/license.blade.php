@extends('emails/layouts/default')

@section('content')

<p>From: (<a href="mailto:{{{ $email }}}">{{{ $email }}}</a>)</p>

<p>{{{ $description }}}</p>

<p>(Message sent from @lang('general.site_name')
)</p>
@stop
