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
      
      <p>Thank you for your interest in requesting data from ISC.  There are two types of data requests: aggregate and full data license requests.  The request processes are different depending on the type of request.  Details are provided below.  </p>
      
      <p>Once your request is submitted, it will be reviewed by ISC and you will be contacted with any questions. After ISC reviews the request, it will be submitted to the ISC Data and Research Oversight Committee, which will review the study, provide any needed feedback, and then vote on whether to approve the study.  ISC will be in contact with you throughout the process.<br/>&nbsp;</p>
      
      <h5>Full Data License Requests:</h5>
      <p>Data license requests are for individual-level de-identified data. ISC distinguishes between data requests and research requests.</p>
      
      <ul class="normal">
      <li><strong>Research requests:</strong><br/>
      If the data will be used for research, then IRB is required in addition to the data license request form.  IRB can be obtained through your own institution or can be facilitated through the UNC Charlotte IRB.  If you will be using the UNC Charlotte IRB, please download and complete the IRB form below.  This IRB form has language filled in regarding the use of ISC data.  Please do not change this language as it needs to be consistent for all research projects using ISC data that go through the UNC Charlotte IRB.  If you have any questions about completing the IRB form or about getting the required Human Subjects training, you can contact <a href="mailto:ashley.clark@uncc.edu">Ashley.Clark@uncc.edu</a>.  You will also need to download and complete the data license request form below.  Once completed, please email the data license request along with the resumes of the research team to <a href="mailto:ashley.clark@uncc.edu">Ashley.Clark@uncc.edu</a>.<br/>&nbsp;</li>
      
      <li><strong>Data requests:</strong><br/>
      Data requests do not require IRB, unless the ISC Data and Research Oversight Committee requests it after reviewing the study.   To request a data license, please download the data license request form below.  Once completed, please email the data license request along with the resumes of the research team to <a href="mailto:ashley.clark@uncc.edu">Ashley.Clark@uncc.edu</a>.<br/>&nbsp;</li>
      </ul>
      
      <h5>Aggregate Data Requests</h5>
      <p>Aggregate data requests are intended to be used for the following purposes:</p>
      
      <ul class="normal">
      <li>Better understand how ISC data deposits overlap</li>
      <li>Data story / Data exploration</li>
      <li>For use in a specific grant application</li>
      <li>For use in advocating for funding</li>
      <li>Interested in exploring potential for a research study</li>
      <li>Other</li>
      </ul>      
      
      <p>To request aggregate data, please download and complete the aggregate data request form. Once completed, please email the aggregate data request form along with the resumes of the research team to <a href="mailto:ashley.clark@uncc.edu">Ashley.Clark@uncc.edu</a>.</p>

      <a href="/media/ISC_License_Request.doc" class="btn btn-primary btn-lg" type="button" target="_blank"> <i class="fa fa-file-word-o"></i>  Download License Request</a><br/><br/>
      <a href="/media/ISC_Aggregate_Request.docx" class="btn btn-primary btn-lg" type="button" target="_blank"> <i class="fa fa-file-word-o"></i>  Download Aggregate License Request</a><br/><br/>
      <a href="/media/IRB_Protocol_1.15.2016.docx" class="btn btn-primary btn-lg" type="button" target="_blank"> <i class="fa fa-file-word-o"></i>  Download IRB Protocol</a>
      <p>&nbsp;</p>
      
    </div>
  </div>
</div>

@stop
