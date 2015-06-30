    <!-- Tabs Content -->
    <div class="tab-content">

        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
        


			<h4> Study details</h4>
			
			<div class="form-group {{ $errors->first('title', 'has-error') }}">
			        <label for="title" class="col-sm-1 control-label">Study title</label>
			        <div class="col-sm-10">
			        {{ Form::text('title', null, ['class' => 'form-control']) }}
			        {{ $errors->first('title', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
	      <div class="form-group {{ $errors->first('user_id', 'has-error') }}">
	          	<div class="col-sm-1">Select user:</div>
	            <div class="col-sm-9">
	              	{{ Form::select('user_id', $user_options , Input::old('user_id'), ['id' => 'user_id', 'class' => 'form-control']) }}
	                {{ $errors->first('user_id', '<span class="help-block">:message</span>') }}
	            </div>
	      </div>

			<div class="form-group {{ $errors->first('irb', 'has-error') }}">
			        <div class="col-sm-1">IRB approved:</div>
			        <div class="col-sm-10">
			        {{ Form::select('irb', $lo, null, array('id' => 'irb', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('irb', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('investigator', 'has-error') }}">
			        <div class="col-sm-1">Data license request and investigator checklist submitted:</div>
			        <div class="col-sm-10">
			        {{ Form::select('investigator', $lo, null, array('id' => 'investigator', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('investigator', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('reviewer', 'has-error') }}">
			        <div class="col-sm-1">Reviewers' checklists completed:</div>
			        <div class="col-sm-10">
			        {{ Form::select('reviewer', $lo, null, array('id' => 'reviewer', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('reviewer', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('vote', 'has-error') }}">
			        <div class="col-sm-1">DAROC vote approval:</div>
			        <div class="col-sm-10">
			        {{ Form::select('vote', $lo, null, array('id' => 'vote', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('vote', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('establish', 'has-error') }}">
			        <div class="col-sm-1">DQRC established:</div>
			        <div class="col-sm-10">
			        {{ Form::select('establish', $lo, null, array('id' => 'establish', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('establish', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('data_extract', 'has-error') }}">
			        <div class="col-sm-1">Data pulled:</div>
			        <div class="col-sm-10">
			        {{ Form::select('data_extract', $lo, null, array('id' => 'data_extract', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('data_extract', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('meeting', 'has-error') }}">
			        <div class="col-sm-1">DQRC meeting held:</div>
			        <div class="col-sm-10">
			        {{ Form::select('meeting', $lo, null, array('id' => 'meeting', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('meeting', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('distribute', 'has-error') }}">
			        <div class="col-sm-1">Data given to investigator:</div>
			        <div class="col-sm-10">
			        {{ Form::select('distribute', $lo, null, array('id' => 'distribute', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('distribute', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<div class="form-group {{ $errors->first('complete', 'has-error') }}">
			        <div class="col-sm-1">Project complete:</div>
			        <div class="col-sm-10">
			        {{ Form::select('complete', $lo, null, array('id' => 'complete', 'class' => 'form-control first-disabled')) }}			        
			        {{ $errors->first('complete', '<span class="help-block">:message</span>') }}
			        </div>
			</div>
			
			<!-- Content/Description -->
			<div class="form-group {{ $errors->first('notes', 'has-error') }}">
			        <label for="notes" class="col-sm-1 control-label">Notes and comments:</label>
			        <div class="col-sm-10">
			        {{ Form::textarea('notes', null, ['class' => 'form-control']) }}
			        {{ $errors->first('notes', '<span class="help-block">:message</span>') }}
			        </div>
			</div>

        </div><!--/.tab-pane -->


     </div><!--/.tab-content -->




    <!-- Form Actions -->
    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-11">
        <a class="btn btn-link" href="{{ route('licenses') }}">@lang('button.cancel')</a>
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
