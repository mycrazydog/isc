@extends('backend/layouts/default')

{{-- Page content --}}
@section('content')

License request status: fldLicenseRequest Approved / Processing / Request

@if (count($posts))

	@foreach ($statuses as $status)
	<div class="row mt">
		<div class="col-lg-12">
			<div class="content-panel" style="padding: 15px;">	
		
			<h4 class="mb"><i class="fa fa-angle-right"></i> Data {{$status->status}}</h4>
			
			<?php
			//$ajaxRouteToTableData = 'datatables/partner/'.$post->id;
			$status_id = $status->id;
			$ajaxRouteToTableData = 'datatables/statuses';
			//echo $partner_id.'-----'.$ajaxRouteToTableData;
			$arrWidths = '"width": "50%"';
			
			if($status_id == 3){
				$colorByStatus = 'danger';
			}elseif($status_id == 2){
				$colorByStatus = 'warning';
			}else{
				$colorByStatus = '';
			}
			
			?>
			
			{{ Datatable::table()
				->addColumn('Partner','Details')  
				->setUrl(route($ajaxRouteToTableData, $status_id))
				->setOptions('paging', false) 
				->setOptions('searching', false) 
				->setOptions('info', false)  
				->setOptions('AutoWidth', false)
				->setOptions('aoColumns', [[ "sWidth"=> "70%" ], [ "sWidth"=> "30%" ]]) 
				->setOptions('aoColumns', [[ "className"=> "$colorByStatus"  ], [ "className"=> "none" ]]) 	
				 
			   ->render() }}
			   
			   
			</div>
		</div>	   
	</div>
		
	@endforeach
		
	{{ $posts->links() }}

@else
	<h1>Oops. That page number is invalid.</h1>
@endif

@stop
