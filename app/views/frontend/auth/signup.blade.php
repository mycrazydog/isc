@extends('frontend/layouts/frontend')

{{-- Page title --}}
@section('title')
@lang('account/title.signup') ::
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

				<!-- Form TERMS license aggreement -->
				<h4>Improving the process or outcomes</h4>
				<p>The proposed project will provide some direction for improving the process or outcomes that the Charlotte Mecklenburg community can use for</p>

				<div class="form-group {{ $errors->first('funding', 'has-error') }}">
					<div class="col-sm-1"></div>
					<div class="col-sm-11">
						{{ Form::checkbox('funding', true) }} funding<br/>
						{{ Form::checkbox('policy', true) }} policy<br/>
						{{ Form::checkbox('program', true) }} program

						{{ $errors->first('funding', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<hr/>
				<h4> Terms and Conditions of Use</h4>

				<div class="form-group {{ $errors->first('evaluate', 'has-error') }}">
					<div class="col-sm-1">Agree: {{ Form::checkbox('evaluate') }}</div>
					<div class="col-sm-10">
						<p><strong>Critically Evaluative Research</strong> Proposed, in-progress, or completed research will be considered “critically evaluative” if, in the sole discretion of the DAROC, the primary purpose or a reasonable consequence of the research will be evaluation of how effective a Partner Agency or a specific program of a Partner Agency is, rather than evaluation of the overall well-being of children or effectiveness of intervention strategies and approaches more broadly. •	If a submitted data request is deemed “Critically Evaluative,” the research proposal will be submitted to DAROC for consideration and will be distributed to all members of the Data Depositors Council no later than one (1) week in advance of the DAROC meeting at which the proposal is reviewed. This research proposal information will contain the name of the project, the names and affiliations of the investigators, and the project abstract. •	DAROC will notify the primary contact at a Subject Agency, as identified in the datasharing agreement, upon the earliest indication, during request, research review or publication, of the specific research effort identified as critically evaluative. A Subject Agency has a right to review and respond to the critically evaluative research prior to publication.</p>
						{{ $errors->first('evaluate', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<div class="form-group {{ $errors->first('responsible', 'has-error') }}">
					<div class="col-sm-1">Agree: {{ Form::checkbox('responsible') }}</div>
					<div class="col-sm-10">
						<p><strong>Researcher responsibilities before disseminating results</strong> Specific guidelines are required of the researcher before disseminating any results in any form,including publication and presentation. For further details, please see the “Requirements for Dissemination” section within the Frequently Asked Questions (FAQs). </p>
						{{ $errors->first('responsible', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<div class="form-group {{ $errors->first('confidential', 'has-error') }}">
					<div class="col-sm-1">Agree: {{ Form::checkbox('confidential') }}</div>
					<div class="col-sm-10">
						<p><strong>Privacy and Confidentiality</strong> Data released to the researcher must be kept secure and is not to be shared with unauthorized persons. Only de-identified data will be released pursuant to a written Limited Data License. Researchers must comply with all license provisions</p>
						{{ $errors->first('confidential', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<div class="form-group {{ $errors->first('irb', 'has-error') }}">
					<div class="col-sm-1">Agree: {{ Form::checkbox('irb') }}</div>
					<div class="col-sm-10">
						<p><strong>IRB Approval</strong> DAROC will not approve any data request for human subjects research unless the research has been reviewed and approved by a qualified Institutional Review Board (IRB).</p>
						{{ $errors->first('irb', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<div class="form-group {{ $errors->first('benefit', 'has-error') }}">
					<div class="col-sm-1">Agree: {{ Form::checkbox('benefit') }}</div>
					<div class="col-sm-10">
						<p><strong>Benefit to the community and the common good</strong> Data requests should provide reasonable potential to benefit the community and the common good. Reasonable benefit to the community and the common good includes any research questions that, when answered, provides some direction for improving processes or outcomes for human service delivery, funding priorities, or policy development. The common good also includes the benefit of developing new knowledge and efforts leading to the development of evidence-based practice.</p>
						{{ $errors->first('benefit', '<span class="help-block">:message</span>') }}
					</div>
				</div>

				<div class="form-group {{ $errors->first('credentials', 'has-error') }}">
					<div class="col-sm-1">Agree: {{ Form::checkbox('credentials') }}</div>
					<div class="col-sm-10">
						<p><strong>Researcher Credentials</strong> The Institute for Social Capital’s Data Research and Oversight Committee (DAROC) will review researcher’s credentials to determine whether the investigator(s) have the appropriate credentials to conduct the proposed research plan before releasing any data. • Credentials for all investigators must be evidenced by appropriate documentation (i.e., curriculum vitae). • Data can only be released to an appropriate agent from one of the following institutions: o An institution of higher education; o A Partner Agency; o An organization funding services and programs related to the Institute’s mission; or o A direct service provider that provides services related to the Institute’s mission.</p>
						{{ $errors->first('credentials', '<span class="help-block">:message</span>') }}
					</div>
				</div>


				<div class="form-group {{ $errors->first('website', 'has-error') }}">
					<label for="website" class="col-sm-1 control-label">Do you have a website?</label>
					<div class="col-sm-10">
						{{ Form::text('website', null, ['class' => 'form-control']) }}
						{{ $errors->first('website', '<span class="help-block">:message</span>') }}
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
