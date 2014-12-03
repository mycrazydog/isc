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
	    <a href="{{ route('partners') }}" class="page-scroll btn btn-xl btn-yellow">Partners</a>
	    <a href="{{ route('signup') }}" class="page-scroll btn btn-green btn-xl">Request access</a>
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
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
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
