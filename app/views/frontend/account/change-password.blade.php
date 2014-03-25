@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.editprofilesubtitle') ::
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
  <h3>@lang('account/title.editprofile')
  <small>@lang('account/title.editprofilesubtitle')</small>
  </h3>
</div>

<form class="form-horizontal" role="form" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Old Password -->
    <!-- Confirm Password -->
    <div class="form-group {{ $errors->first('old_password', 'has-error') }}">
        <label for="old_password" class="col-sm-3 control-label">@lang('account/form.oldpassword')</label>
            <div class="col-sm-5">
                <input type="password" id="old_password" name="old_password" class="form-control">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- New Password -->
    <div class="form-group {{ $errors->first('password', 'has-error') }}">
        <label for="password" class="col-sm-3 control-label">@lang('account/form.newpassword')</label>
            <div class="col-sm-5">
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('password', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Confirm New Password  -->
    <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
        <label for="password_confirm" class="col-sm-3 control-label">@lang('account/form.confirmpassword')</label>
            <div class="col-sm-5">
                <input type="password" id="password_confirm" name="password_confirm" class="form-control">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <hr>

    <!-- Form actions -->
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-default">@lang('button.update')</button>

            <a href="{{ route('forgot-password') }}" class="btn btn-link">@lang('button.forgotpassword')</a>
        </div>
    </div>
</form>
@stop
