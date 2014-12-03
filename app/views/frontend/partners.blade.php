@extends('frontend/layouts/frontend')

{{-- Page title --}}
@section('title')
About us ::
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
  <h3>Partners <small>who we work with?</small></h3>
</div>

<img class="media-object img-responsive" alt="Responsive image"src="http://placekitten.com/1140/300">


	@foreach ($statuses as $status)
	<div class="row mt">
		<div class="col-lg-12">
			<div class="content-panel" style="padding: 15px;">	
		
			<h4 class="mb"><i class="fa fa-angle-right"></i> Data {{$status->status}}</h4>
			
			<table class="table table-striped table-hover">
			    <thead>
			        <tr>
			            <th class="span6">@lang('admin/posts/table.title')</th>
			        </tr>
			    </thead>
			    <tbody>
			        @foreach ($status->posts as $post)
			        
			        <tr>
			            <td>{{ $post->title }}</td>
			        </tr>
			        @endforeach
			    </tbody>
			</table>
			   
			   
			</div>
		</div>	   
	</div>
		
	@endforeach
		








@stop
