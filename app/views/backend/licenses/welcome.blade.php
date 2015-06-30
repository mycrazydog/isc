@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
	Request Data License ::
	@parent
@stop

{{-- Page content --}}
@section('content')

<h3>Request Data License</h3>

<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel">
      <p>&nbsp;</p>
      <p>Thank you for your interest, please download the PDF below, and email the completed form to <a href="mailto:ashley.clark@uncc.edu">Ashley Clark</a>.</p>

      <p><strong>Ashley Clark</strong><br>
        Data and Research Coordinator<br>
        <a href="mailto:ashley.clark@uncc.edu">ashley.clark@uncc.edu</a> 704-687-1193</p>

      <a href="/media/ISC_License_Request.doc" class="btn btn-primary btn-lg" type="button" target="_blank"> <i class="fa fa-file-word-o"></i>  Download License Request</a>
      <a href="/media/ISC_Aggregate_Request.docx" class="btn btn-primary btn-lg" type="button" target="_blank"> <i class="fa fa-file-word-o"></i>  Download Aggregate License Request</a>
      <p>&nbsp;</p>
    </div>
  </div>
</div>

@stop
