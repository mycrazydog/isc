@extends('backend/layouts/default')

{{-- Page content --}}
@section('content')



@if (count($posts))

	@foreach ($statuses as $status)


	<?php
	//$ajaxRouteToTableData = 'datatables/partner/'.$post->id;
	$status_id = $status->id;
	$ajaxRouteToTableData = 'datatables/statuses';
	//echo $partner_id.'-----'.$ajaxRouteToTableData;
	$arrWidths = '"width": "50%"';

		if($status_id == 4){
			$colorByStatus = 'darkgrey';
		}elseif($status_id == 3){
			$colorByStatus = 'beige';
		}elseif($status_id == 2){
			$colorByStatus = 'grey';
		}else{
			$colorByStatus = 'white';
		}



	?>


	<div class="row">
		<div class="col-lg-12 mb">
			<div class="{{ $colorByStatus }}-panel" style="padding: 15px;">

			<div class="{{ $colorByStatus }}-header">
				<h5>{{$status->status}}</h5>
			</div>

			{{ Datatable::table()
				->addColumn('Partner','Tags/Topics','Details')
				->setUrl(route($ajaxRouteToTableData, $status_id))
				->setOptions('paging', false)
				->setOptions('searching', true)
				->setOptions('info', false)
				->setOptions('AutoWidth', false)
				->setOptions('aoColumns', [[ "sWidth"=> "40%" ], [ "sWidth"=> "40%" ], [ "sWidth"=> "20%" ]])
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
