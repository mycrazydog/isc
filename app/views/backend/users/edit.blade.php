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
    <li><a href="#tab-details" data-toggle="tab">User details</a></li>
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
                    {{ Form::hidden('PreviousActivatedStatus', $user->isActivated(), array('id' => 'PreviousActivatedStatus') ) }}
                    
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
	
	                            <label for="{{{ $permission['permission'] }}}_deny" onclick="" class="radio-inline control-label col-sm-1">
	                                <input type="radio" value="-1" id="{{{ $permission['permission'] }}}_deny" name="permissions[{{{ $permission['permission'] }}}]"{{ (array_get($userPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
	                                Deny
	                            </label>
                        </div><!--/form-group -->
                        @endforeach

                    </fieldset>
                    @endforeach

                </div>
            </div>
        </div>
        
        <!-- User details tab -->
        <div class="tab-pane" id="tab-details">
         @if($details)
        	<h4>Improving the process or outcomes</h4>
        	            <p>The proposed project will provide some direction for improving the process or outcomes that the Charlotte Mecklenburg community can use for</p>
        	
        	            <div class="form-group">
        	                    <div class="col-sm-1"></div>
        	                    <div class="col-sm-11">
        	                     {{ Form::checkbox('funding', $details->funding, $details->funding, ['disabled' => 'disabled']) }} funding<br/>
        	                     {{ Form::checkbox('policy', $details->policy, $details->policy, ['disabled' => 'disabled']) }} policy<br/>
        	                     {{ Form::checkbox('program', $details->program, $details->program, ['disabled' => 'disabled']) }} program        	
        	                    
        	                    </div>
        	            </div>
        	
        	      <hr/>
        	      <h4> Terms and Conditions of Use</h4>
        	
        	      <div class="form-group">
        	              <div class="col-sm-1">Agree: {{ Form::checkbox('evaluate', $details->evaluate, $details->evaluate, ['disabled' => 'disabled']) }}</div>
        	              <div class="col-sm-10">
        	              <p><strong>Critically Evaluative Research</strong> Proposed, in-progress, or completed research will be considered “critically evaluative” if, in the sole discretion of the DAROC, the primary purpose or a reasonable consequence of the research will be evaluation of how effective a Partner Agency or a specific program of a Partner Agency is, rather than evaluation of the overall well-being of children or effectiveness of intervention strategies and approaches more broadly. •	If a submitted data request is deemed “Critically Evaluative,” the research proposal will be submitted to DAROC for consideration and will be distributed to all members of the Data Depositors Council no later than one (1) week in advance of the DAROC meeting at which the proposal is reviewed. This research proposal information will contain the name of the project, the names and affiliations of the investigators, and the project abstract. •	DAROC will notify the primary contact at a Subject Agency, as identified in the datasharing agreement, upon the earliest indication, during request, research review or publication, of the specific research effort identified as critically evaluative. A Subject Agency has a right to review and respond to the critically evaluative research prior to publication.</p>
        	             
        	              </div>
        	      </div>
        	
        	      <div class="form-group">
        	              <div class="col-sm-1">Agree: {{ Form::checkbox('responsible', $details->responsible, $details->responsible, ['disabled' => 'disabled']) }}</div>
        	              <div class="col-sm-10">
        	              <p><strong>Researcher responsibilities before disseminating results</strong> Specific guidelines are required of the researcher before disseminating any results in any form,including publication and presentation. For further details, please see the “Requirements for Dissemination” section within the Frequently Asked Questions (FAQs). </p>
        	              </div>
        	      </div>
        	
        	      <div class="form-group">
        	              <div class="col-sm-1">Agree: {{ Form::checkbox('confidential', $details->confidential, $details->confidential, ['disabled' => 'disabled']) }}</div>
        	              <div class="col-sm-10">
        	              <p><strong>Privacy and Confidentiality</strong> Data released to the researcher must be kept secure and is not to be shared with unauthorized persons. Only de-identified data will be released pursuant to a written Limited Data License. Researchers must comply with all license provisions</p>
        	              </div>
        	      </div>
        	
        	      <div class="form-group">
        	              <div class="col-sm-1">Agree: {{ Form::checkbox('irb', $details->irb, $details->irb, ['disabled' => 'disabled']) }}</div>
        	              <div class="col-sm-10">
        	              <p><strong>IRB Approval</strong> DAROC will not approve any data request for human subjects research unless the research has been reviewed and approved by a qualified Institutional Review Board (IRB).</p>
        	              </div>
        	      </div>
        	
        	      <div class="form-group">
        	              <div class="col-sm-1">Agree: {{ Form::checkbox('benefit', $details->benefit, $details->benefit, ['disabled' => 'disabled']) }}</div>
        	              <div class="col-sm-10">
        	              <p><strong>Benefit to the community and the common good</strong> Data requests should provide reasonable potential to benefit the community and the common good. Reasonable benefit to the community and the common good includes any research questions that, when answered, provides some direction for improving processes or outcomes for human service delivery, funding priorities, or policy development. The common good also includes the benefit of developing new knowledge and efforts leading to the development of evidence-based practice.</p>
        	              </div>
        	      </div>
        	
        	      <div class="form-group">
        	              <div class="col-sm-1">Agree: {{ Form::checkbox('credentials', $details->credentials, $details->credentials, ['disabled' => 'disabled']) }}</div>
        	              <div class="col-sm-10">
        	              <p><strong>Researcher Credentials</strong> The Institute for Social Capital’s Data Research and Oversight Committee (DAROC) will review researcher’s credentials to determine whether the investigator(s) have the appropriate credentials to conduct the proposed research plan before releasing any data. • Credentials for all investigators must be evidenced by appropriate documentation (i.e., curriculum vitae). • Data can only be released to an appropriate agent from one of the following institutions: o An institution of higher education; o A Partner Agency; o An organization funding services and programs related to the Institute’s mission; or o A direct service provider that provides services related to the Institute’s mission.</p>
        	              </div>
        	      </div>
        	
        	
        	      <div class="form-group">
        	              <label for="initial" class="col-sm-1 control-label">Requesting User's Website</label>
        	              <div class="col-sm-10">
        	               <strong>{{ $details->website }}</strong>
        	              </div>
        	      </div>
        @endif	           
        </div><!--/tab-details -->
        
        
        
        
        
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
