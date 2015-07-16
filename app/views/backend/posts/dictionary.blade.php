@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
	Codebook :: @parent
@stop

{{-- Page content --}}
@section('content')

	<h3>Codebook - Data depositors</h3>



<div class="table-responsive">
<table class="table table-hover">
    <thead>
        <tr>         
            <th>Depositor</th>
            <th>Tags/Topics</th>
            <th>Deposit Status</th>            
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{{ $post->title }}}</td>
            <td>            
				<?php $not_first = false; ?>
				
				@foreach ($post->tags as $key => $tag)            
					
					<?php
					if ($not_first) {
				        print(", ");
				    }
				    $not_first = true;
					?>
					{{ $tag->name }}
					

					
				@endforeach          
            </td>
            <td>
            	@foreach ($post->statuses as $status)            
            		{{ $status->name }}
            	@endforeach  
            </td>
            <td>
            	@if($post->status_id == 2)           
                        <span class="btn btn-warning disabled" >Codebook available soon</span> 
                 @else
                 		<a class="open-DetailDialog btn btn-primary" href="{{ URL::to('admin/dictionary/'.$post->slug) }} ">View codebook</a> 
                 @endif       
                       
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>



@stop
