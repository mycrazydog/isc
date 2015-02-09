@extends('emails/layouts/default')

@section('content')
<p>Hello,</p>

<p>A new user account has been requested by: <strong>{{{ $user->first_name }}} {{{ $user->last_name }}}</strong></p>

<p>Please sign in to review their account: <a href="http://charlotteresearch.info/auth/signin">sign in</a></p>

<p>Please use the following url to immediately activate their account: <a href="{{{ $activationUrl }}}">activate</a></p>

<p>Best regards,</p>

<p>@lang('general.site_name') Team</p>
@stop
