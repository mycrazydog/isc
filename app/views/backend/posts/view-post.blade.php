@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
{{ $post->title }} ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')

@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')

@parent
@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')

@parent
@stop

{{-- Page content --}}
@section('content')
<h3>{{{ $post->title }}}</h3>



<div class="row">

				<div class="col-xs-2 col-min">
        	<div class="form-panel">

							@if ($post->img())
							<img class="img-responsive" src="/logos/{{{ $post->filePartnerLogo }}}" alt="{{{ $post->filePartnerLogo }}}">
							@endif
							<br/>
							<a class="btn btn-primary" href="{{{ $post->partnerwebsite }}}" target="_blank">visit website <i class="fa fa-share"></i></a>



          	</div><!-- /form-panel -->
          </div>

					<div class="col-xs-3 col-min">
						<div class="form-panel">

							<h5><i class="fa fa-angle-right"></i> Status</h5>
							<span class="btn btn-round btn-info">{{{ Status::find($post->status_id)->status }}}</span>

							<br/><br/>
							<h5><i class="fa fa-angle-right"></i> Years Available</h5>
							{{{ $post->yearsavailable }}}

						</div><!-- /form-panel -->
					</div>


					<div class="col-xs-7">
							<div class="form-panel">
					  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Depositor Description</h4>
					      <p>{{ nl2br(e($post->content())) }}</p>
						</div><!-- /form-panel -->
					</div>

</div>



<div class="row">

				<div class="col-lg-12">
          			<div class="form-panel">
	          			<div class="form-group">
	                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Notes on data source</h4>
							<p>{{ nl2br(e($post->notessource)) }}</p>
						</div>

						<div class="form-group">
					  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Notes on data</h4>
					     <p>{{ nl2br(e($post->notescleaning)) }}</p>
					    </div>

					    <div class="form-group">
					    	  <h4 class="mb"><i class="fa fa-angle-right"></i> Version notes</h4>
					      <p>{{ nl2br(e($post->notesversion)) }}</p>
					    </div>
					</div><!-- /form-panel -->
				</div>

</div>

<div class="row mt">
	<div class="col-lg-12">
		<div class="content-panel" style="padding: 15px;">



<!--
http://stackoverflow.com/questions/10626885/passing-data-to-a-bootstrap-modal
<a class="open-DetailDialog btn btn-primary" data-toggle="modal" data-target="#DetailModal" data-id="DUMB" data-column="ASS" >Details</a>
-->




		<!--MODAL BOX -->
		<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="DetailModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h4 class="modal-title" id="DetailModalLabel">Modal title</h4>
		      </div>
		      <div class="modal-body">
					<!--<input type="text" name="bookId" id="bookId" value=""/>-->
						<table id="detailTable" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Data Value</th>
									<th>Data Type</th>
									<th>Data Label</th>
					            </tr>
					        </thead>
					    </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!--END MODAL BOX -->

	<h4 class="mb"><i class="fa fa-angle-right"></i> Depositor data</h4>
	<!--<a href="{{ route('update/post', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a><br/>-->

	<?php
	//$ajaxRouteToTableData = 'datatables/partner/'.$post->id;
	$partner_id = $post->id;
	$ajaxRouteToTableData = 'datatables/partner';
	//echo $partner_id.'-----'.$ajaxRouteToTableData;
	?>
   	

	   	<div id="filter"></div>
	   <table id="partnerTable" class="display" cellspacing="0" width="100%">	   		
	   </table>
	   
	   
	  
	   	   
	   	   	   	
	   	
	   
	   
	   
		</div>
	</div>
</div>



<div class="row mt">
	<div class="col-lg-12">
		<div class="content-panel" style="padding: 15px;">
    <span class="badge badge-info" title="{{{ $post->created_at }}}">
    @lang('post.posted')
    {{ $post->created_at->diffForHumans() }}</span>
    	</div>
	</div>
</div>




<!--DISABLE COMMENTS
<hr />

<a id="comments"></a>
<h4>{{ $comments->count() }} @lang('post.comments')</h4>

@if ($comments->count())
@foreach ($comments as $comment)
<div class="row">
    <div class="col-sm-1">
        <img class="img-thumbnail pull-left" src="{{{ $comment->author->gravatar() }}}" alt="">
    </div>
    <div class="col-sm-11">
                <span class="muted">{{{ $comment->author->fullName() }}}</span>
                &bull;
                <span title="{{{ $comment->created_at }}}">{{{ $comment->created_at->diffForHumans() }}}</span>
                <p>
                	{{ nl2br(e($comment->content())) }}
                </p>
    </div>
</div>
<hr />
@endforeach
@else
<hr />
@endif

@if ( ! Sentry::check())
@lang('post.messages.login')
<br /><br />
@lang('post.messages.loginprompt', array('signin' => route('signin')))
@else
<h4>@lang('post.addcomment')</h4>
<form class="form-horizontal" role="form" method="post" action="{{ route('view-post', $post->slug) }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="form-group {{ $errors->first('comment', 'has-error') }}">
        <div class="col-sm-20">
            {{ $errors->first('comment', '<span class="help-block">:message</span>') }}
            <textarea rows="4" id="comment" name="comment" class="form-control" placeholder="Type your comment here"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-1">
          <button type="submit" class="btn btn-default">@lang('post.postcomment')</button>
        </div>
    </div>

</form>
@endif
-->

@stop

{{-- Page content --}}
@section('body_bottom')

	   	<script type="text/javascript">
	   	$(document).ready(function() {
	   	
	
			var dataURL = '{{ route($ajaxRouteToTableData, $partner_id) }}';
			//console.log(dataURL);

			
			//$('#partnerTable').text(myColumn);
			
					var mytable = $('#partnerTable').DataTable({
					    "language": {"emptyTable": "No data available for column:"},
					    "processing": false,
					    "paging": true,
					    "searching": true,
					    "bStateSave": true,
					    "ajax": dataURL,
					   // "sAjaxDataProp": "aaData",	
					    "columns": [
					  { "title": "Table"}, 
			          { "title": "Fields"},
			          { "title": "Data Type <a title='This is a sentence explaining the difference between numeric and nvarchar'><i class='a fa-question-circle'></i></a>" },
			          { "title": "Max Length" },
			          { "title": "Complete" },
			          { "title": "Total Rows" },
			          { "title": "% Complete" },
			          { "title": "Description" },
			          { "title": "" }			          
					     ]
					     
					    	     
				  });
				  
				  yadcf.init(mytable , [{column_number : 0, filter_type: "multi_select", select_type: "chosen", filter_default_label: "Select Tables"}]);


				  	


	   	});

	   	</script>

@stop
