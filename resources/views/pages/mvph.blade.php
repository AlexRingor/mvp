@extends ('template.template_no_navbar')

@section ("title", "MVPH")

@section ("content")
<div class="container-fluid ml-0 mr-0 pr-0 pl-0 vh-100 login_body">
	<div class="welcome">
		
		@if(!empty(Auth::user()))
		<a href="{{url('landingpage')}}">

			<h1 class="text-center" style="color: #ffb700;">MotovloggersPH</h1>
		</a>

		@else

		<a href="{{url('login')}}">

			<h1 class="text-center" style="color: #ffb700;">MotovloggersPH</h1>
		</a>
		@endif
		{{-- <h6 class="text-center" style="color: #ffb700;">ENTER</h6> --}}
	</div>
</div>

@endsection