@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Change your Password
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
  <h1>Edit Profile <small>Change Your Password</small></h1>
</div>

<form class="form-horizontal" role="form" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Old Password -->
	<!-- Confirm Password -->
	<div class="form-group {{ $errors->first('old_password', 'has-error') }}">
		<label for="old_password" class="col-sm-3 control-label">Old Password</label>
			<div class="col-sm-9">
			<input type="password" id="old_password" name="old_password" class="form-control">
			{{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
			</div>
	</div>

	<!-- New Password -->
	<div class="form-group {{ $errors->first('password', 'has-error') }}">
		<label for="password" class="col-sm-3 control-label">New Password</label>
			<div class="col-sm-9">
			<input type="password" id="password" name="password" class="form-control">
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
			</div>
	</div>

	<!-- Confirm New Password  -->
	<div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
		<label for="password_confirm" class="col-sm-3 control-label">New Password</label>
			<div class="col-sm-9">
			<input type="password" id="password_confirm" name="password_confirm" class="form-control">
			{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
			</div>
	</div>

	<hr>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-default">Update Password</button>

			<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
		</div>
	</div>
</form>
@stop

