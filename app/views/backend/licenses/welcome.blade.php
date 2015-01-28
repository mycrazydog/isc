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
        <a href="mailto:ashley.clark@uncc.edu">ashley.clark@uncc.edu</a><span>
          <span id="gc-number-1" class="gc-cs-link" title="Call with Google Voice">704-687-1193</span></span></p>

      <a href="/pdf/license-form.pdf" class="btn btn-primary btn-lg" type="button"> <i class="fa fa-file-pdf-o"></i>  Download</a>
      <p>&nbsp;</p>
    </div>
  </div>
</div>

@stop
