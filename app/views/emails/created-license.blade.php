@extends('emails/layouts/default')
@section('content')




<h3>Creation of data license:</h3>
<p>Hi {{ $user }},</p>

<p>This email is to notify you that your data license request for <strong>{{ $title }}</strong> has been received.
As your project moves through the data license request process, you will periodically receive an email updating you as to its status.
Additionally, please keep an eye out for emails from ISC with any questions regarding your request.
If you have any questions, please reach out to me (<a href="mailto:ashley.clark@uncc.edu">Ashley.Clark@uncc.edu</a>).</p>

<p>Thank you,<br>
Ashley Clark</p>

____________________________________
<p style="font-size:10px;">Ashley Williams Clark, MCRP<br>
Data and Research Coordinator| Institute for Social Capital<br>
UNC Charlotte | Urban Institute |<br>
9201 University City Blvd. | Charlotte, NC 28223<br>
Phone: 704-687-1193 | Fax: 704-687-5327<br>
<a href="mailto:ashley.clark@uncc.edu">Ashley.Clark@uncc.edu</a> | <a href="http://ui.uncc.edu">http://ui.www.uncc.edu</a></p>


@stop
