@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Contact us ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>Contact us</h3>
</div>

<form class="form-horizontal" role="form" method="post" action="">
<!-- CSRF Token -->
<input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="form-group {{ $errors->first('name', 'has-error') }}">
        <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-5">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="{{{ Input::old('name') }}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('name', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <div class="form-group {{ $errors->first('email', 'has-error') }}">
        <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{{ Input::old('email') }}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <div class="form-group {{ $errors->first('description', 'has-error') }}">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">{{ $errors->first('description', '<span class="help-block">:message</span>') }}
            <textarea rows="4" id="description" name="description" class="form-control" placeholder="Type your message here">{{{ Input::old('description') }}}</textarea>

            </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>

</form>
@stop
