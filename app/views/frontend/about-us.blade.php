@extends('frontend/layouts/frontend')

{{-- Page title --}}
@section('title')
About us ::
@parent
@stop

{{-- Header section --}}
@section('header')
	<div class="page-topper">
		<!-- Notifications -->
		@include('frontend/notifications')                
	</div>
@stop

{{-- Page content --}}
@section('content')

<div class="page-header">
  <h3>About Us <small>who are we?</small></h3>
</div>

<img class="media-object img-responsive" alt="Responsive image"src="http://placekitten.com/1140/300">

<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec lorem nibh. Nullam lobortis porta augue, at luctus nibh commodo vel. Vivamus a laoreet velit. Praesent vulputate lacus ante, eu lacinia nunc volutpat et. Donec eros turpis, ornare vitae sollicitudin in, consectetur non justo. Donec luctus et ante eget sodales. Praesent id lectus in libero suscipit porta. Praesent posuere augue a erat pulvinar venenatis. Ut auctor lorem interdum, convallis libero a, egestas augue. In ut nulla odio. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis faucibus lectus metus, non mollis elit mattis eget. In ornare arcu quis elementum auctor. Donec a ipsum vehicula, tempor nulla a, fermentum dolor. Maecenas ac hendrerit leo. Donec tempor elit elit, sit amet pharetra lectus volutpat ac.
</p>
<p>
Morbi ultrices neque nisi, quis lacinia nibh cursus at. Sed dapibus nisl sed tincidunt laoreet. Proin auctor pulvinar mauris. Cras id venenatis odio, et pulvinar orci. Praesent ultrices augue ligula. Integer tellus ante, elementum et tincidunt eget, volutpat eget sapien. Nulla et enim commodo, iaculis tellus nec, sollicitudin nunc. Ut varius nulla sit amet nulla accumsan, ut ultricies tortor rhoncus. Nulla facilisi. Vestibulum tincidunt nunc vitae metus hendrerit, id pellentesque quam tincidunt. Curabitur velit erat, congue vel dui vitae, pretium cursus diam.
</p>

@stop
