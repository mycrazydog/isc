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
  	<li><a href="#">Home</a></li>
  	<li><a href="#">Import</a></li>
  	<li class="active">Preview</li>
	</ol>
	
	<div class="page-header">Original filename:{{$fileName}}	/ Import Batch-id {{$batch_id}}</div>
	
	
		<ul class="nav nav-tabs" id="Tab_" >
		  	<li class="active"><a href="#Data" data-toggle="tab">Preview</a></li>
	  		<li ><a href="#Missing" data-toggle="tab">Missing</a></li>
		</ul>

		<div class="tab-content"> 				
  				<div class="tab-pane fade in active" id="Data" >
				<!-- Preview Tabs -->  		
						<br><br>				
						<table class="table table-striped table-hover" >
						<thead>
								<tr>
									<th class="col-md-1">meas_id</th>
									<th class="col-md-3">meas_date</th>
									<th class="col-md-1">station_id</th>
									<th class="col-md-3">name</th>
									<th class="col-md-1">max_temp</th>
									<th class="col-md-1">min_temp</th>
									<th class="col-md-1">rain</th>
									<th class="col-md-1">avgrh</th>
									<th class="col-md-1">evapor</th>
									<th class="col-md-1">mean_temp</th>
									<th class="col-md-1">source_name</th>							
								</tr>
							</thead>
						</table>

				</div><!--/end tab-pane-->
  				
  				
  				<div class="tab-pane fade " id="Missing">
  				 <!-- Missing Tabs --> 
  				 	<br><br>
					<table  id="gridview" class="table table-striped table-bordered table-hover ">
					<thead>
				        <tr>	        
		      				<th>dt</th>
		        	        <th>meas_date</th>
		        	        <th>station_id</th>
		        	        <th>max_temp</th>
		        	        <th>min_temp</th>
		        	        <th>rain</th>
		        	        <th>avgrh</th>
		        	        <th>evapor</th>
		        	        <th>mean_temp</th>
		        	        <th>source</th>
		        	        <th>batch</th>
	        			</tr>
      			</thead>
      	     	<tbody>
      	     
      	      	<?php 
					$missingg = DB::table('tbl_temp_measurement')
					->select('meas_id', 'meas_date','station_id','max_temp','min_temp',
					'rain','avgrh','evapor','mean_temp','source','batch_id')->get();
					
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
		

	


{{ Form::open(array('url' => 'import/upload','files' => true)) }}
			<?php 
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
	
@endsection




{{-- body_bottom --}}
@section('body_bottom')
  
   
	{{ HTML::script('packages/datatables/js/dataTables.bootstrap.js')}}

	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			
//			oTable = $('#gridview').dataTable( {
//				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
//				
//				"oLanguage": {
//					"sLengthMenu": "_MENU_"
//				},
//				"bProcessing": true,
//		        "bServerSide": true,
//		        "iDisplayLength": 25,		        
//		        		        
//		        "sAjaxSource": "{{ URL::to('import/data') }}",
//		    
//			});
			oTable = $('#gridview').DataTable();

		});
	</script>
@endsection


	