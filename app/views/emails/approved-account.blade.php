@extends('emails/layouts/default')

@section('content')
<p>Hello {{{ $user->first_name }}},</p>

<p>You have been approved to access the codebook. Thank you for registering.</p>

<p>You may proceed with logging in to our site with the credentials you setup during registration.<br/><a href="http://charlotteresearch.info/auth/signin">http://charlotteresearch.info/auth/signin</a></p>

<p>Best regards,</p>

<p>@lang('general.site_name') Team</p>
@stop
