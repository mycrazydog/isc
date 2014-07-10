@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
User Update ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        User Update

        <div class="pull-right">
            <a href="{{ route('users') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
        </div>
    </h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
    <li><a href="#tab-permissions" data-toggle="tab">Permissions</a></li>
</ul>

<form class="form-horizontal" role="form" method="post" action="">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
        <br>
            <!-- First Name -->
            <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                <label for="first_name" class="col-sm-2 control-label">@lang('admin/users/form.firstname')</label>
                    <div class="col-sm-5">
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="{{{ Input::old('first_name', $user->first_name) }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Last Name -->
            <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                <label for="last_name" class="col-sm-2 control-label">@lang('admin/users/form.lastname')</label>
                    <div class="col-sm-5">
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="{{{ Input::old('last_name', $user->last_name) }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Email -->
            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                <label for="email" class="col-sm-2 control-label">@lang('admin/users/form.email')</label>
                    <div class="col-sm-5">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{{ Input::old('email', $user->email) }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Password -->
            <div class="form-group {{ $errors->first('password', 'has-error') }}">
                <label for="password" class="col-sm-2 control-label">@lang('admin/users/form.password')</label>
                    <div class="col-sm-5">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{{ Input::old('password') }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Password Confirm -->
            <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                <label for="password_confirm" class="col-sm-2 control-label">@lang('admin/users/form.confirmpassword')</label>
                    <div class="col-sm-5">
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Password" value="{{{ Input::old('password_confirm') }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                    </div>

            </div>

            <!-- Activation Status -->
            <div class="form-group {{ $errors->first('activated', 'has-error') }}">
                <label for="activated" class="col-sm-2 control-label">@lang('admin/users/form.activated')</label>
                    <div class="col-sm-5">
                        <select{{ ($user->id === Sentry::getId() ? ' disabled="disabled"' : '') }} name="activated" id="activated">
                        <option value="1"{{ ($user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
                        <option value="0"{{ ( ! $user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.no')</option>
                    </select>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('activated', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Groups -->
            <div class="form-group {{ $errors->first('groups', 'has-error') }}">
                <label for="groups" class="col-sm-2 control-label">@lang('admin/users/form.groups')</label>
                    <div class="col-sm-5">
                        <select name="groups[]" id="groups[]" multiple>
                        @foreach ($groups as $group)
                        <option value="{{{ $group->id }}}"{{ (array_key_exists($group->id, $userGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">@lang('admin/users/form.grouphelp')</span>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('groups', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

        </div>

        <!-- Permissions tab -->
        <div class="tab-pane" id="tab-permissions">
            <div class="controls">
                <div class="control-group">

                    @foreach ($permissions as $area => $permissions)
                    <fieldset>
                        <h4>{{ $area }}</h4>

                        @foreach ($permissions as $permission)
                        <div class="form-group">
                            <label class="control-label radio-inline col-sm-2">{{ $permission['label'] }} </label>
                            <label for="{{{ $permission['permission'] }}}_allow" onclick="" class="radio-inline control-label col-sm-1">
                                <input type="radio" value="1" id="{{{ $permission['permission'] }}}_allow" name="permissions[{{{ $permission['permission'] }}}]"{{ (array_get($userPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}> Allow
                            </label>

                            <label for="{{{ $permission['permission'] }}}_deny" onclick="" class="radio-inline control-label   col-sm-1">
                                    <input type="radio" value="-1" id="{{{ $permission['permission'] }}}_deny" name="permissions[{{{ $permission['permission'] }}}]"{{ (array_get($userPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
                                    Deny
                                </label>
                            </div>

                        </div>
                        @endforeach

                    </fieldset>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- Form actions -->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <a class="btn btn-link" href="{{ route('users') }}">@lang('button.cancel')</a>
            <button type="submit" class="btn btn-default">@lang('button.save')</button>
        </div>
    </div>

</form>
@stop
