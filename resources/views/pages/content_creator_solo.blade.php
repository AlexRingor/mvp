@extends('template.template')

@section ("title", "MotovloggersPH")

@section ("content")
<div class="container">
	
<div class="row">
	<div class="col-lg-12 p-0 mb-2" id="landingpage_scroll">
			
			@foreach($json_result as $indiv_json_result)
			@foreach ($indiv_json_result->items as $indiv)
			<a href="/content-creator/{{$indiv->id}}">
				
				
				<img class="img-fluid universal" src="{{$indiv->brandingSettings->image->bannerTabletHdImageUrl}}" alt="">

			</a>

			@endforeach
			@endforeach
		</div>
</div>
</div>



@endsection