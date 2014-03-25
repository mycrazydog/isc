@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.changeemailsubtitle') ::
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
  <h3>@lang('account/title.editprofile')
  <small>@lang('account/title.changeemailsubtitle')</small>
  </h3>
</div>

<form class="form-horizontal" role="form" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Form type -->
    <input type="hidden" name="formType" value="change-email" />

    <!-- New Email -->
    <div class="form-group {{ $errors->first('email', 'has-error') }}">
        <label for="email" class="col-sm-3 control-label">@lang('account/form.newemail')</label>
            <div class="col-sm-5">
                <input type="email" id="email" name="email" class="form-control" placeholder="New Email">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Confirm Email -->
    <div class="form-group {{ $errors->first('email_confirm', 'has-error') }}">
        <label for="email" class="col-sm-3 control-label">@lang('account/form.confirmemail')</label>
            <div class="col-sm-5">
                <input type="email" id="email_confirm" name="email_confirm" class="form-control" placeholder="Confirm Email">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Confirm Password -->
    <div class="form-group {{ $errors->first('current_password', 'has-error') }}">
        <label for="email" class="col-sm-3 control-label">@lang('account/form.oldpassword')</label>
            <div class="col-sm-5">
                <input type="password" id="current_password" name="current_password" class="form-control">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
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
