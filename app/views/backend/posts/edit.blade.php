@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.edit') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        @lang('admin/posts/title.edit') - {{ $post->title }} 
        

        <div class="pull-right">
            <a href="{{ route('posts') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
        </div>
    </h3>
</div>

<script>
$(function() {
 
    $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",
 
        inserting: true,
        editing: true,
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
		
		    
		    insertItem: function(item) {
		    	item._token = "{{ csrf_token() }}";
		    	item.partner_id = "{{ $post->id }}";
		        return $.ajax({
		            type: "POST",
		            url: "http://charlotteresearch.info/api/datastatus",
		            data: item,
		            dataType: "json"
		        });
		    },
		    
		    
		
		    updateItem: function(item) {
		    	item._token = "{{ csrf_token() }}";
		        return $.ajax({
		            type: "PUT",
		            url: "http://charlotteresearch.info/api/datastatus/"+item.id,
		            data: item,
		            dataType: "json"
		        });
		    },
		
		    deleteItem: function(item) {
		    	item._token = "{{ csrf_token() }}";
		        return $.ajax({
		            type: "DELETE",
		            url: "http://charlotteresearch.info/api/datastatus/"+item.id,
		            data: item,
		            dataType: "json"
		        });
		    },
        },
 
        fields: [
            
            { name: "year", type: "text", align: "center"},
            { name: "status", type: "text", align: "center"},
            { type: "control" }
        ]
    });
 
});
</script>

<div id="jsGrid"></div>

<hr/>

<!-- Tabs
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab">@lang('admin/posts/form.general')</a></li>
    <li><a href="#tab-meta-data" data-toggle="tab">@lang('admin/posts/form.metadata')</a></li>
</ul>
!/ Tabs -->

{{ Form::model($post, [
        'route' => ['update/post', $post->id],
        'files'=> true,
        'class'=>'form-horizontal'
    ]) }}

	<!-- CSRF Token -->
	{{ Form::token() }}

	@include('backend/posts/partials/_form')

{{ Form::close() }}

@stop
