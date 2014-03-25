@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('account/title.signup') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>@lang('account/title.signup')</h3>
</div>
<div class="row">
    <form method="post" action="{{ route('signup') }}" class="form-horizontal" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <!-- First Name -->
        <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
        <label for="first_name" class="col-sm-2 control-label">@lang('account/form.firstname')</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="{{ Input::old('first_name') }}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <!-- Last Name -->
        <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
        <label for="last_name" class="col-sm-2 control-label">@lang('account/form.lastname')</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="{{ Input::old('last_name') }}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <!-- Email -->
        <div class="form-group {{ $errors->first('email', 'has-error') }}">
            <label for="email" class="col-sm-2 control-label">@lang('account/form.email')</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ Input::old('email') }}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <!-- Email Confirm -->
        <div class="form-group {{ $errors->first('email_confirm', 'has-error') }}">
            <label for="email_confirm" class="col-sm-2 control-label">@lang('account/form.confirmemail')</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email_confirm" id="email_confirm" placeholder="Re-Type Address" value="{{ Input::old('email_confirm') }}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <!-- Password -->
        <div class="form-group {{ $errors->first('password', 'has-error') }}">
            <label for="password" class="col-sm-2 control-label">@lang('account/form.password')</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password" id="password" value="{{ Input::old('password') }}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('password', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <!-- Password Confirm -->
        <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
            <label for="password_confirm" class="col-sm-2 control-label">@lang('account/form.confirmpassword')</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="{{ Input::old('password_confirm') }}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <hr>

        <!-- Form actions -->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn" href="{{ route('home') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-default">@lang('button.signup')</button>
            </div>
        </div>

    </form>
</div>
@stop
