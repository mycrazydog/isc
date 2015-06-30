@extends('frontend/layouts/frontend')

{{-- Page title --}}
@section('title')
Contact us ::
@parent
@stop


{{-- Header section --}}
@section('header')
	<div class="page-topper">
		<!-- Notifications -->
		@include('frontend/notifications')
	</div>
@stop


{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>Contact us</h3>
</div>



<div class="contact-links">

	<p><strong>Amy Hawn Nelson</strong><br>
	Director<br>
	<a href="mailto:Amy.hawn.nelson@uncc.edu">amy.hawn.nelson@uncc.edu</a>
	704-687-1197</p>

	<p><strong>Ashley Clark</strong><br>
	Data and Research Coordinator<br>
	<a href="mailto:ashley.clark@uncc.edu">ashley.clark@uncc.edu</a>	704-687-1193</p>

	<p><strong>David Hill</strong><br>
	Research Associate/ Database Scientist<br>
	<a href="mailto:dchill@uncc.edu">dchill@uncc.edu</a>	704-687-1190</p>

	<p><strong>Diane Gavarkavich</strong><br/>
		Data and Research Specialist<br>
		<a href="mailto:D.Gavarkavich@uncc.edu">D.Gavarkavich@uncc.edu</a>		704.687.1194</p>


	<p><strong>Ida Stavenger</strong><br>
	Business Services Coordinator<br>
	<a href="mailto:imstaven@uncc.edu?subject=ISC">imstaven@uncc.edu</a>	704-687-1208</p>

</div>



<!--<f class="form-horizontal" role="form" method="pt" action="">

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

</f-->
@stop
