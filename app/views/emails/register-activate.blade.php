@extends('emails/layouts/default')

@section('content')
<p>Hello {{{ $user->first_name }}},</p>

<p>Welcome to @lang('general.site_name'): Thank you for registering.</p>

<p>We are reviewing your account and will email you if your account is approved to access the codebook.</p>

<p>Best regards,</p>

<p>@lang('general.site_name') Team</p>
@stop
