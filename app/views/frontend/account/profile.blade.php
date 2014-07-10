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

    <!-- First Name -->
    <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
        <label for="first_name" class="col-sm-3 control-label">@lang('account/form.firstname')</label>
            <div class="col-sm-5">
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="{{{ Input::old('first_name', $user->first_name) }}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Last Name -->
    <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
        <label for="last_name" class="col-sm-3 control-label">@lang('account/form.lastname')</label>
            <div class="col-sm-5">
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="{{{ Input::old('last_name', $user->last_name) }}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Website URL -->
    <div class="form-group {{ $errors->first('website', 'has-error') }}">
        <label for="website" class="col-sm-3 control-label">@lang('account/form.website')</label>
            <div class="col-sm-5">
                <input type="text" id="website" name="website" class="form-control" placeholder="http://www.yoursite.com" value="{{{ Input::old('website', $user->website) }}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('website', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Country -->
    <div class="form-group {{ $errors->first('country', 'has-error') }}">
        <label for="country" class="col-sm-3 control-label">@lang('account/form.country')</label>
            <div class="col-sm-5">
                {{ Form::countries('country', Input::old('country', $user->country), 'form-control') }}
            </div>
            <div class="col-sm-4">
                {{ $errors->first('country', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Gravatar Email -->
    <div class="form-group {{ $errors->first('gravatar', 'has-error') }}">
        <label for="gravatar" class="col-sm-3 control-label">@lang('account/form.gravataremail')</label>
            <div class="col-sm-5">
            <input type="email" id="gravatar" name="gravatar" class="form-control" value="{{{ Input::old('gravatar', $user->gravatar) }}}">
            <p>
            <img src="{{ $user->gravatar() }}" width="30" height="30" />
            <a href="http://gravatar.com">@lang('account/form.changegravatar')</a>.
            </div>
            <div class="col-sm-4">
            {{ $errors->first('gravatar', '<span class="help-block">:message</span>') }}

            </div>
        </p>
    </div>

    <hr>

    <!-- Form actions -->
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-default">Update your Profile</button>
        </div>
    </div>
</form>
@stop
