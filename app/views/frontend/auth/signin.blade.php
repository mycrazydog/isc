@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign in ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>Sign in into your account</h3>
</div>
<div class="row">
	<form class="form-horizontal" role="form" method="post" action="{{ route('signin') }}">

		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<!-- Email -->
		<div class="form-group {{ $errors->first('email', 'has-error') }}">
			<label for="email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-4">
				<input type="email" class="form-control" name="email" id="email" value="{{ Input::old('email') }}">
				{{ $errors->first('email', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Password -->
		<div class="form-group {{ $errors->first('password', 'has-error') }}">
			<label for="password" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="password" id="password">
				{{ $errors->first('password', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Remember me -->
		<div class="checkbox">
			<div class="col-sm-2">
			</div>
			<label for="remember-me">
			 	<input type="checkbox" name="remember-me" id="remember-me" value="1" /> @lang('button.rememberme')
			</label>
		</div>

		<hr>

		<!-- Form actions -->
		<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-default">@lang('button.signin')</button>
		  <a href="{{ route('forgot-password') }}" class="btn btn-link">@lang('button.forgotpassword')</a>
		</div>

  	</div>

	</form>
</div>
@stop
