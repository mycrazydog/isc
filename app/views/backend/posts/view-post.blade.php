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
	<div class="col-lg-12">
		<div class="form-panel">
			@if ($post->img())
			<img class="img-responsive" style="max-width:250px" src="/logos/{{{ $post->filePartnerLogo }}}" alt="{{{ $post->filePartnerLogo }}}">
			@endif
			<p><a href="{{{ $post->partnerwebsite }}}" target="_blank">{{{ $post->partnerwebsite }}} <i class="fa fa-share"></i></a></p>
			
			<p>{{ nl2br(HTML::decode($post->content())) }}</p>		
						
			
			<h5><i class="fa fa-angle-right"></i> Data Status</h5>
			<!--Status::find($post->status_id)->status }}}-->
			
			<script>
			$(function() {
			 
			    $("#jsGrid").jsGrid({
			        height: "auto",
			        width: "100%",
			 
			        inserting: false,
			        editing: false,
			        sorting: false,
			        paging: false,
			        autoload: true,
			 
			        controller: {
					    loadData: function(filter) {
					        return $.ajax({
					            type: "GET",
					            url: "http://charlotteresearch.info/api/datastatus/{{ $post->id }}",
					            data: filter,
					            dataType: "json"
					        });
					    },
			        },
			 
			        fields: [            
			            { name: "year", type: "text", align: "center"},
			            { name: "status", type: "text", align: "center"},
			        ]
			    });
			 
			});
			</script>
			
			<div id="jsGrid"></div>		
				
		</div><!-- /form-panel -->
	</div>
</div>



<div class="row">
	<div class="col-lg-12">
		<div class="form-panel">
			<!--
			<div class="form-group">
	      	  <h4 class="mb"><i class="fa fa-angle-right"></i> Notes on data source</h4>
				<p>$post->notessource</p>
			</div>
			-->
	
			<div class="form-group">
		  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Notes on data</h4>
		     <p>{{ nl2br(HTML::decode($post->notescleaning)) }}</p>
		    </div>
	
		    <div class="form-group">
		    	  <h4 class="mb"><i class="fa fa-angle-right"></i> Version notes</h4>
		      <p>{{ nl2br(HTML::decode($post->notesversion)) }}</p>
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
						<div id="DetailModalDescription"></div>
						
						<table id="detailTable" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Data Value</th>									
									<th>Notes</th>
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
					    "paging": false,
					    "searching": true,
					    "bStateSave": true,
					    "ajax": dataURL,
					   // "sAjaxDataProp": "aaData",	
					    "columns": [					    
					  { "title": "Table", "data": "TBL"}, 
			          { "title": "Fields", "data": "CLM"},
			          { "title": "Max Length", "data": "max_length"},
			          { "title": "Complete", "data": "complete"},
			          { "title": "Total Rows", "data": "total_rows"},
			          { "title": "Percent Complete", "data": "pct_complete"},
			          {
			              "class":          "details-control",
			              "title":			"Description",
			              "orderable":      false,
			              "data":           null,
			              "defaultContent": "<a class=\"btn btn-success\">Description</a>"
			          },
			          { "title": "", "data": "actived"}	          
					     ]
					     
					    	     
				  });
				  
				  function format ( d ) {
				      return '<strong>Description:</strong>  '+d['description'];
				  }
				  
				  
				     // Array to track the ids of the details displayed rows
				     var detailRows = [];
				  
				     $('#partnerTable tbody').on( 'click', 'tr td.details-control', function () {
				         var tr = $(this).closest('tr');
				         var row = mytable.row( tr );
				         var idx = $.inArray( tr.attr('id'), detailRows );
				  
				         if ( row.child.isShown() ) {
				             tr.removeClass( 'details' );
				             row.child.hide();
				  
				             // Remove from the 'open' array
				             detailRows.splice( idx, 1 );
				         }
				         else {
				             tr.addClass( 'details' );
				             console.log(row.data());
				             row.child( format( row.data() ) ).show();
				  
				             // Add to the 'open' array
				             if ( idx === -1 ) {
				                 detailRows.push( tr.attr('id') );
				             }
				         }
				     } );
				  
				     // On each draw, loop over the `detailRows` array and show any child rows
				     mytable.on( 'draw', function () {
				         $.each( detailRows, function ( i, id ) {
				             $('#'+id+' td.details-control').trigger( 'click' );
				         } );
				     } );
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  mytable.search( '' ).columns().search( '' ).draw();
				  
				  yadcf.init(mytable , [{column_number : 0, filter_type: "select", select_type: "chosen", filter_default_label: "Select a Table", filter_reset_button_text: "clear"}]);


				  	
//			          { "title": "Data Type <a title='This is a sentence explaining the difference between numeric and nvarchar'><i class='a fa-question-circle'></i></a>" },

	   	});

	   	</script>

@stop
