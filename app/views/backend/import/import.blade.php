@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('admin/groups/title.management') ::
@parent
@stop

{{-- Content --}}
@section('content')

	<ol class="breadcrumb">
	  	<li><a href="{{ route('home') }}">Home</a></li>
	  	<li class="active">Import</li>
	</ol>
		
	
	
	<?php 
	if ($errors->first('file') != NULL) {
		echo "<div class='alert alert-danger' role='alert'>lll".$errors->first('file') ."</div>";
		echo $message;
	}
		
	?>	
	{{$message}}
	
{{ Form::open(array('url' => 'import','files' => true, 'class'=>'form-horizontal')) }}

			<div class="form-group">
				
				<div class="col-sm-3">Select file:</div>
				<div class="col-md-3">
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						

				  		
				  		<div class="form-control">				  				 
				  				<input type="file" name="file">
				  		</div>					
						
				  		<!--<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove-circle"></span></a>-->
					</div>
				</div>
				<div class="col-md-6"></div>
			</div>


            <!--STATUS GOES HERE-->
            <div class="form-group {{ $errors->first('status', 'has-error') }}">
                <label for="status" class="col-sm-3 control-label">Select partner</label>
                    <div class="col-sm-5">                    
                    	{{ Form::select('partner_id', $partner_options , Input::old('partner_id')) }}
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('status', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- yearsavailable-->
            <div class="form-group {{ $errors->first('batch_description', 'has-error') }}">
                    <label for="batch_description" class="col-sm-3 control-label">@lang('admin/posts/form.yearsavailable')</label>
                    <div class="col-sm-9">
                    {{ Form::textarea('batch_description', null, ['class' => 'form-control']) }}
                    {{ $errors->first('batch_description', '<span class="help-block">:message</span>') }}
                    </div>
            </div>



			<!-- Form Actions -->
			<div class="form-group">
			  <div class="col-sm-offset-2 col-sm-10">
			      
			    
			    <?php echo Form::button('<i class="glyphicon glyphicon-upload"></i> Upload',
			    	 	array('class' => 'btn btn-default','id' => 'submit','type'=>'submit'))?>
			    
			    
			  </div>
			</div>

{{ Form::close() }}

<br>

<div class="panel panel-success">
  <div class="panel-heading">
	  <span class="glyphicon glyphicon-floppy-save"></span> Download 
  </div>
  <div class="panel-body">
   	<li><a href="{{URL::to('import/template')}}"><i class="glyphicon glyphicon-list-alt"></i> Template </a></li>
	<li><a href="{{URL::to('import/example')}}">	<i class="glyphicon glyphicon-list-alt"></i> Example </a></li>  </div>
  </div>
</div>

@endsection



{{-- body_bottom --}}
@section('body_bottom')
 
<script type="text/javascript">
$(document).ready(function(){

	$('#file').change(function(){

		var fileInput = $('#file');
		console.log(fileInput.val());

		$("#upload-file-info").html("<code>"+"<span class=\"glyphicon glyphicon-file\"></span>"+$(this).val())+"</code>";

		});
	
})
</script>
	
@endsection	