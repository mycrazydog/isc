@extends('frontend/layouts/frontend')

{{-- Page title --}}
@section('title')

@parent

@stop

{{-- Header section --}}
@section('header')

	<div class="intro-text">
		<!-- Notifications -->
		    @include('frontend/notifications')

	    <div class="intro-lead-in">Welcome to The Institute for Social Capital<br/> Database Information Portal</div>
	    <div  class="intro-heading" style="font-size:23px;line-height:40px;">Our online information portal where you can access our data dictionary and download our data license request form. </div>


			<a href="" data-toggle="modal" data-target="#login_confirm" class="page-scroll btn btn-yellow btn-xl">Access codebook</a>

	</div>

@stop


{{-- Page content --}}
@section('content')




    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About the ISC</h2>
                    <h3 class="section-subheading text-muted">The ISC’s mission is to advance university research and increase the community’s capacity for data-based planning and evaluation.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-green"></i>
                        <i class="fa fa-cubes fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">The value of data sharing</h4>
                    <p class="text-muted">To best serve vulnerable individuals within our community, we must communicate across the silos of data created by governmental and community agencies.
Sharing creates more accurate evaluation of policy options, improved stewardship of taxpayer dollars, reduced paperwork burdens, and more coordinated delivery of public services.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-green"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Integrated data system</h4>
                    <p class="text-muted">An integrated data system holds administrative data from numerous organizations and can match information across these organizations at the individual level.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-green"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Data protection</h4>
                    <p class="text-muted">All data released from the ISC Community Database are de-identified and aggregated.
The ISC Data and Research Oversight Committee (DAROC) always includes a member of the agency whose data is requested for research. This member approves data request and data set before release to the researcher.</p>
                </div>
            </div>
        </div>
    </section>


@stop


{{-- Body Bottom confirm modal --}}
@section('body_bottom')
<div class="modal fade" id="login_confirm" tabindex="-1" role="dialog" aria-labelledby="user_login_confirm_title" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Access codebook</h4>
			</div>





			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 text-center">
						<p><a href="{{ route('signup') }}" class="page-scroll btn btn-yellow btn-xl">Request access</a></p>
					</div>
				</div>

				<div class="row">

					<hr>

					<div class="col-lg-12 text-center">
						<p>Already have an account? Then please sign in below.</p>
				  </div>

					<form class="form-horizontal" role="form" method="post" action="{{ route('signin') }}">

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

						<!-- Password -->
						<div class="form-group {{ $errors->first('password', 'has-error') }}">
							<label for="password" class="col-sm-2 control-label">@lang('account/form.password')</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password" id="password">
							</div>
							<div class="col-sm-4">
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

						<hr/>

						<!-- Form actions -->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">@lang('button.signin')</button>
								<a href="{{ route('forgot-password') }}" class="btn btn-link">@lang('button.forgotpassword')</a>
							</div>

						</div>

					</form>

				</div>
			</div><!--modal-body-->


		</div>
	</div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop
