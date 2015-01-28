@extends('backend/layouts/default')

{{-- Page content --}}
@section('content')

<h3>Data depositors</h3>


@if (count($posts))

<?php
$ajaxRouteToTableData = 'datatables/statuses';
?>

<div class="row">
	<div class="col-lg-12 mb">
		<div class="white-panel" style="padding: 15px;">





			{{ Datatable::table()
				->addColumn('Depositor','Tags/Topics','Deposit Status','Details')
				->setUrl(route($ajaxRouteToTableData))
				->setOptions('paging', false)
				->setOptions('searching', true)
				->setOptions('info', false)
				->setOptions('AutoWidth', false)
				->setOptions('aoColumns', [[ "sWidth"=> "35%" ], [ "sWidth"=> "25%" ], [ "sWidth"=> "25%" ], [ "sWidth"=> "15%" ]])
				->render() }}

			</div>
		</div>
	</div>


@else
	<h1>Oops. That page number is invalid.</h1>
@endif

@stop
