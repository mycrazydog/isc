@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create request ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="page-header">
    <h3>
        Create request for data license

        <div class="pull-right">
            <a href="{{ route('licenses') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
        </div>
    </h3>
</div>



{{ Form::open(array('class'=>'form-horizontal')) }}
	<!-- CSRF Token -->
	{{ Form::token() }}
	
	@include('backend/licenses/partials/_form')

{{ Form::close() }}


@stop