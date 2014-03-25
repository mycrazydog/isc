@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('account/title.forgotpassword') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>@lang('account/title.forgotpassword')</h3>
</div>
<form method="post" action="" class="form-horizontal">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Email -->
    <div class="form-group {{ $errors->first('email', 'has-error') }}">
            <label for="email" class="col-sm-2 control-label">@lang('account/form.email')</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" id="email" value="{{ Input::old('email') }}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email', '<span class="help-block">:message</span>') }}
            </div>
        </div>

    <!-- Form actions -->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a class="btn" href="{{ route('home') }}">@lang('button.cancel')</a>
          <button type="submit" class="btn btn-default">@lang('button.submit')</button>
        </div>
    </div>

</form>
@stop
