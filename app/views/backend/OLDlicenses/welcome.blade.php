@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/licenses/title.blogmanagement') ::
@parent
@stop

{{-- Page content --}}
@section('content')

<h3>Download License Request</h3>

<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel">
      <p>&nbsp;</p>
      <p>Thank you for your interest, please download the PDF below, and email the completed form to <a href="mailto:ashley.clark@uncc.edu">Ashley Clark</a>.</p>

      <p><strong>Ashley Clark</strong><br>
        Data and Research Coordinator<br>
        <a href="mailto:ashley.clark@uncc.edu">ashley.clark@uncc.edu</a> 704-687-1193</p>

      <a href="/pdf/ISC_License_Request.pdf" class="btn btn-primary btn-lg" type="button"> <i class="fa fa-file-pdf-o"></i>  Download License Request</a>
      <a href="/pdf/ISC_Aggregate_Request.pdf" class="btn btn-primary btn-lg" type="button"> <i class="fa fa-file-pdf-o"></i>  Download Aggregate License Request</a>
      <p>&nbsp;</p>
    </div>
  </div>
</div>

@stop
