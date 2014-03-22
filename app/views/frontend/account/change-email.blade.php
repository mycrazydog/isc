@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Change your Email
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
  <h1>Edit Profile <small>Change Your Email Address</small></h1>
</div>

<form class="form-horizontal" role="form" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Form type -->
	<input type="hidden" name="formType" value="change-email" />

	<!-- New Email -->
	<div class="form-group {{ $errors->first('email', 'has-error') }}">
		<label for="email" class="col-sm-3 control-label">New Email</label>
			<div class="col-sm-9">
			<input type="email" id="email" name="email" class="form-control" placeholder="New Email">
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
			</div>
	</div>

	<!-- Confirm Email -->
	<div class="form-group {{ $errors->first('email_confirm', 'has-error') }}">
		<label for="email" class="col-sm-3 control-label">Confirm Email</label>
			<div class="col-sm-9">
			<input type="email" id="email_confirm" name="email_confirm" class="form-control" placeholder="Confirm Email">
			{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
			</div>
	</div>

	<!-- Confirm Password -->
	<div class="form-group {{ $errors->first('current_password', 'has-error') }}">
		<label for="email" class="col-sm-3 control-label">Current Password</label>
			<div class="col-sm-9">
			<input type="password" id="current_password" name="current_password" class="form-control">
			{{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
			</div>
	</div>


	<hr>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-default">Update Email</button>

			<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
		</div>
	</div>
</form>
@stop
