@extends('emails/layouts/default')

@section('content')
<p>Hello,</p>

<p>A new user account has been requested by: {{{ $user->first_name }}} {{{ $user->last_name }}}</p>

<p>Please use the follwing url to activate their account: <a href="{{{ $activationUrl }}}">{{{ $activationUrl }}}</a></p>

<p>Best regards,</p>

<p>@lang('general.site_name') Team</p>
@stop
