@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('admin/groups/title.management') ::
@parent
@stop

{{-- Style --}}
@section('style')

@endsection

{{-- Content --}}
@section('content')


	<ol class="breadcrumb">
  	<li><a href="{{ route('home') }}">Home</a></li>
  	<li><a href="{{ URL::to('import') }}">Import</a></li>
  	<li class="active">Preview</li>
	</ol>

	<div class="page-header">Original 	 <br/>Import Batch-id: {{$batch_id}} <!--/ Distinct Check: -distinct_check--></div>


		<ul class="nav nav-tabs" id="Tab_" >
		  	<li class="active"><a href="#Data" data-toggle="tab">Parent</a></li>
	  		<li ><a href="#Missing" data-toggle="tab">Child</a></li>
		</ul>

		<div class="tab-content">
  				<div class="tab-pane fade in active" id="Data" >
					{{ Datatable::table()
					   ->addColumn('TBL', 'CLM')
					   ->setUrl(route('datatables'))
					   ->render() }}

				</div><!--/end tab-pane-->


  				<div class="tab-pane fade " id="Missing">
  				 <!-- Missing Tabs -->
  				 	<br><br>
					<table  id="gridview-child" class="table table-striped table-bordered table-hover ">
					<thead>
				        <tr>
		      				<th>table_name</th>
		        	        <th>column_name</th>
		        	        <th>data_value</th>
	        			</tr>
	      			</thead>
	      	     	<tbody>

	      	      	<?php
						$missingg = DB::table('tabDataChild')->select('table_name', 'column_name', 'data_value')->get();

						foreach ($missingg as $row) {
							echo '<tr>';
							foreach ($row as $key => $cell) {
								if($cell == NULL) $cell ='<span class="glyphicon glyphicon-remove"></span>';
								echo '<td> '.$cell.' </td>';
							}
							echo '</tr>';
						}
					?>
	      	     	</tbody>
					</table>

  				</div><!--/end tab-pane-->
		</div><!--/end tab-content-->




<!--
{{ Form::open(array('url' => 'import/upload','files' => true)) }}
			< php
				echo Form::button('<i class="glyphicon glyphicon-ok-sign"></i> Submit',
				array('class' => 'btn btn-info btn-sm','id' => 'submit','type'=>'submit'))
			?>
		 <a href="{{ URL::previous() }}">
		 <button type="button" class="btn btn-sm btn-danger iframe">
			  <span class="glyphicon glyphicon-remove-circle"></span>
			 cancle
		 </button></a>


<br><br>
<br><br>
{{ Form::close() }}
-->

@endsection




{{-- body_bottom --}}
@section('body_bottom')



@endsection
