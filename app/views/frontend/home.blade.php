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

	    <div class="intro-lead-in">Welcome to The Institute for Social Capital<br/>Community Database Information Portal</div>

	    
	    @if (Sentry::check())
	    <a href="{{ URL::to('admin/dictionary')  }}" class="btn btn-yellow btn-xl">Access Codebook</a>    
	    @else
	    <a href="" data-toggle="modal" data-target="#login_confirm" class="btn btn-yellow btn-xl">Access codebook</a>
	    @endif

	</div>

@stop


{{-- Page content --}}
@section('content')




    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our Mission</h2>
                    <h3 class="section-subheading text-muted">The ISC’s mission is to advance university research and increase the community’s capacity for data-based planning and evaluation.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
						<i class="fa fa-circle fa-stack-2x text-green"></i>
						<i class="fa fa-code-fork fa-stack-1x fa-inverse"></i>
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
    
    <!-- About us Section -->
    <section id="aboutus" class="bg-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                         <div class="text-center">
	                        <h2 class="section-heading">About ISC</h2>
	                        <h3 class="section-subheading text-muted">Who we are</h3>                        
	                       <img class="media-object img-responsive" alt="Charlotte Skyline - photo: James Willamor" src="/assets/img/custom/skyline.jpg">
                       </div>
                        
                        <p>The <strong>Institute for Social Capital</strong>, Inc. was founded in 2004, and became part of the UNC Charlotte Urban Institute in March 2012. Its mission is to support university research and increase the community’s capacity for data-informed decision-making.</p>
                        
                        <p>At its core, there is a comprehensive set of administrative data gathered from governmental and nonprofit agencies in the region. By combining key data into one community database, ISC provides a valuable resource for understanding the outcomes for the most vulnerable members of our communities from a multi-agency context.</p>
                        
                        <p>Through its affiliation with UNC Charlotte and the UNC Charlotte Urban Institute, ISC also offers valuable analytical support to assist organizations in their research and data analyses efforts.</p>
                        
                        <p>One of the most significant struggles facing researchers and social service organizations is the diffusion of human and social data. Reliable data gathered from significant social service and nonprofit agencies are needed to understand the effects of relevant initiatives on planning services, program evaluations and public policy. However, such information is rarely shared across sources, limiting an organization’s ability to effectively measure outcomes.</p>
                        
                        <p>By combining key sources of data into one community database, ISC provides a valuable resource to assess the impact of specific interventions across agency lines and to better understand the social and environmental variables that affect the community, particularly with regard to outcomes for children and families.</p>
                        
                        <p><em>The ISC is a 501(c)3 nonprofit dedicated to maintaining the confidentiality of these crucial data.</em></p>
                        
                    </div>
                </div>
                
            </div>
    </section>
    
    <!-- FAQ Section -->
    <section id="faq">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">FAQ</h2>
                        <h3 class="section-subheading text-muted">You have questions, we have answers.</h3>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">                    

                    	


                    	      <h3>What is the Institute for Social Capital (ISC)?</h3>
                    	      <div class="panel-body">
                    	       <p>ISC, Inc. is a 501(c)(3) organization that provides oversight for the ISC Community Database, which is the only integrated data system in North Carolina. The ISC’s mission is to advance university research and increase the community’s capacity for data-based planning and evaluation.</p>
                    	      </div>

                    	      <h3>What is an integrated data System?</h3>
                    	      <div class="panel-body">
                    	        <p>An integrated data system holds administrative data from numerous organizations and can match information across these organizations at the individual level. For example, the information about students in a certain school can be matched to data from the Department of Social Services so that a school can better understand its population. Or, a nonprofit organization can match its program list to both these agencies to learn how to better serve its target population. Therefore, an integrated data system (IDS) is a unique resource and powerful tool for local program evaluation and policy formulation.</p>
                    	      </div>
                    	    
                    	      <h3>What is administrative data?</h3>
                    	      <div class="panel-body">
                    	        <p>Administrative data is the information that organizations and agencies collect in the process of their daily work. This information includes demographics such as race and age as well as program use and data like student attendance and community arrest records.</p>
                    	      </div>
                    	    
                    	      <h3>What is the purpose of using administrative data in research?</h3>                    	          
                    	      <div class="panel-body">
                    	        <p>Administrative data is not collected for research purposes. However, it is useful data for researchers because it does not rely on self-report and it tells us who uses what services and how much. If a study wanted to look at the impact of absenteeism on test scores, a researcher could survey individual students for information on their attendance and test scores. This information already exists as administrative data, which means that researchers can study a population instead of a sample. Without using administrative data that has already been collected, this research is very difficult, time-consuming, and expensive. Using administrative data is not only faster and easier, it can provide more statistically powerful results.</p>
                    	      </div>
                    	      	
                    	      <h3>What procedures are in place to protect this data?</h3>
                    	      <div class="panel-body">
                    	        <p>The data in the ISC Community Database is individual level, identifiable data so that data can be linked across agencies. Therefore, the ISC has numerous procedures in place to protect the data. Most importantly, each data depositor enters into a rigorous legal data sharing agreement with ISC, Inc. This agreement explicitly states the expectations of confidentiality and security. Researchers who would like to use data from the ISC database must first have IRB approval.</p>
                    	        
                    	        <p>Once IRB approval is obtained, the researcher submits a Data License Request to the ISC Data and Research Oversight Committee (DAROC), which provides oversight of the ISC Community Database and reviews all research requests. DAROC includes University researchers and members of the community, including a representative from each data depositor. The agency that owns the data being requested must approve the use of their data during the approval process.</p>
                    	        
                    	        <p>No researcher will ever see identifiable data. The ISC’s Database Administrator links and matches data on a secure terminal that is not connected to a network, then the data is deidentified and sent to DAROC for review.</p>
                    	      </div>
                    	      
                    	      
                    	      <h3>What administrative data does the ISC hold?</h3>
                    	      <div class="panel-body">
                    	        <p>We are always in the process of negotiating data sharing agreements with local government and non-profit agencies. Please access the Codebook portion of the website to access a full list of our depositors.</p>
                    	      </div>


                    	      <h3>What kind of projects use the ISC community database?</h3>
                    	      <div class="panel-body">
                    	        <p>ISC collaborates with both researchers and community members. Therefore, data from the ISC Community Database is used for research projects such as investigating the educational attainment of Black males who attended Charlotte-Mecklenburg Schools then UNC Charlotte.</p>
                    	      </div>

                    	      <h3>How can I use the ISC community database for my research?</h3>                   	          
                    	      <div class="panel-body">
                    	      	<p><strong>Codebook:</strong> If you are an academic researcher, we have a codebook for each of our data depositors. To access the codebook, visit <a href="http://charlotteresearch.info">http://charlotteresearch.info</a> to request access.</p>
                    	      	
                    	      	<p><strong>Research requests:</strong> If you believe the data outlined in the codebook is a good fit for your research and you would like to use data from the ISC Community Database, contact Data and Research Coordinator, Ashley Williams Clark (<a href="mailto:Ashley.Clark@uncc.edu">Ashley.Clark@uncc.edu</a>) to set-up a meeting.</p>
                    	      	
                    	      	<p><strong>Program Evaluations:</strong> If you are a community organization who is interested in evaluating a program or programs using the ISC Community Database, contact Data and Research Specialist, Diane Gavarkavich to set-up a meeting.</p>
                    	      	
                    	      	<p>For all general questions about ISC, Inc. or becoming a data depositor, contact Director of the Institute for Social Capital, Amy Hawn Nelson.</p>
                    	      </div>
                    	    
                    	       <h3>How ISC protects data</h3>
                    	      <div class="panel-body">
                    	      	<ul>
                    	      	<li>All data released from the ISC Community Database are de-identified and aggregated.</li>
                    	      	<li>The ISC Data and Research Oversight Committee (DAROC) always includes a member of the agency whose data is requested for research. This member approves data request and data set before release to the researcher.</li>
                    	      	</ul>
                    	      	
                    	      </div>

                    	      <h3>What you need for a study using ISC data</h3>
                    	      <div class="panel-body">
                    	        <ul>
                    	        <li>Before a Data License Request can be submitted, the study must have IRB approval.</li>
                    	        <li>Any study using ISC data needs to submit a Data License Request to the ISC Data and Research Oversight Committee (DAROC), which provides another layer of security.</li>
                    	        <li>DAROC members will review the Data License Request and approved IRB application. They may deny the request, or request modifications or clarifications prior to approval.</li>
                    	        </ul>
                    	      </div>
                    	

	                </div>
	            </div><!-- /.row -->            
            </div><!-- /.container -->            
    </section>
    
    <!-- Contact us Section -->
    <section id="contactus" class="bg-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Contact Us</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="sentMessage" id="contactForm" novalidate="">
                            <div class="row contact-links">
                                <div class="col-md-2"></div>
                                
                                <div class="col-md-4">                                
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
                                </div>
                                <div class="col-md-4">                                
                            		<p><strong>Diane Gavarkavich</strong><br/>
                            		Data and Research Specialist<br>
                            		<a href="mailto:d.gavarkavich@uncc.edu">d.gavarkavich@uncc.edu</a>		704.687.1194</p>                                
                            	
                            		<p><strong>Ida Stavenger</strong><br>
                            		Business Services Coordinator<br>
                            		<a href="mailto:imstaven@uncc.edu?subject=ISC">imstaven@uncc.edu</a>	704-687-1208</p>                                  
                                </div>
                                <div class="col-md-2"></div>
                                
                            </div>
                        </form>
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
