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
	if ($errors->first('file_parent') != NULL || $errors->first('file_child') != NULL) {
		echo "<div class='alert alert-danger' role='alert'>".$errors->first('file') ."</div>";
		echo $message;
	}
	?>


	@if ($errors->has())
		<div class="alert alert-danger">
		    @foreach ($errors->all() as $error)
		        {{ $error }}<br>        
		    @endforeach
		</div>
	@endif
	
	@if ($message)
		<div class="alert alert-warning">
			{{ $message }}
		</div>
	@endif



{{ Form::open(array('files' => true, 'class'=>'form-horizontal')) }}


<!-- CSRF Token -->
{{ Form::token() }}

			<!-- Parent File -->
			<div class="form-group">
				<div class="col-sm-3">Select Master/Parent file</div>
				<div class="col-md-3">
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">

				  		<div class="form-control">
				  				<input type="file" name="file_parent">
				  		</div>

				  		<!--<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove-circle"></span></a>-->
					</div>
				</div>
				<div class="col-md-6"></div>
			</div>

			<!-- Child File -->
			<div class="form-group">
				<div class="col-sm-3">Select Detail/Child file</div>
				<div class="col-md-3">
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">

						<div class="form-control">
							<input type="file" name="file_child">
						</div>

						<!--<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove-circle"></span></a>-->
					</div>
				</div>
				<div class="col-md-6"></div>
			</div>


      <!--Status-->
      <div class="form-group {{ $errors->first('partner_id', 'has-error') }}">
          <label for="partner_id" class="col-sm-3 control-label">Select depositor</label>
              <div class="col-sm-5">
              	{{ Form::select('partner_id', $partner_options , Input::old('partner_id'), ['id' => 'partner_id', 'class' => 'form-control']) }}

              </div>
              <div class="col-sm-4">
                  {{ $errors->first('partner_id', '<span class="help-block">:message</span>') }}
              </div>
      </div>

      <!-- Description -->
      <div class="form-group {{ $errors->first('batch_description', 'has-error') }}">
              <label for="batch_description" class="col-sm-3 control-label">Batch Description</label>
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

	<div class="panel panel-danger">
	  <div class="panel-heading">
		 <h3><i class="glyphicon glyphicon-exclamation-sign"></i> Please Note</h3>
	  </div>
	  <div class="panel-body">
		  <!--
			<li><a href="{{URL::to('import/template')}}"><i class="glyphicon glyphicon-list-alt"></i> Template </a></li>
			<li><a href="{{URL::to('import/example')}}">	<i class="glyphicon glyphicon-list-alt"></i> Example </a></li>
			-->

			<p><strong>Files that you upload must include the following columns</strong><p>

			<h4>Master/Parent</h4>

			<li>table_name</li>
			<li>column_name</li>
			<li>data_type</li>
			<li>max_length</li>
			<li>complete</li>
			<li>total_rows</li>
			<li>pct_complete</li>
			<li>description</li>

			<h4>Detail/Child</h4>

			<li>table_name</li>
			<li>column_name</li>
			<li>data_value</li>
			<li>data_type</li>
			<li>data_label</li>

		</div>
  </div>


@endsection



{{-- body_bottom --}}
@section('body_bottom')

<script type="text/javascript">
/*
$(document).ready(function(){

	$('input:file').change(function(){

		var fileInput = $('input:file');

		console.log(fileInput.val());

		$("#upload-file-info").html("<code>"+"<span class=\"glyphicon glyphicon-file\"></span>"+$(this).val())+"</code>";

		});

})
*/
</script>

@endsection
