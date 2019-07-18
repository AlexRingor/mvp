@extends('template.template')

@section ("title", "Video")

@section("content")
	<div class="container">
		<div class="text-center mt-5">
			<div class="row">
		
					
			
				<div class="col-lg-6">

		@foreach($result->items as $indiv_item)
			{{-- @foreach ($indiv_item as $item) --}}
				<iframe width="480" height="360" src="https://www.youtube.com/embed/{{$indiv_item->id}}" frameborder="0" allowfullscreen></iframe>
				<div class="col-lg-12" id="left_content_creator">
					
                <h6>{{$indiv_item->snippet->title}}</h6>
				<p class="text-left">{{$indiv_item->snippet->description}}</p>
				</div>
				
		@endforeach
				</div>
				<div class="col-lg-5" id="right_content_creator">
						
					@foreach($commentResult->items as $indiv_comment)
					<div class="row">
						<div class="col-lg-12">
							
						<p class="bg-warning rounded p-1 ">{{$indiv_comment->snippet->topLevelComment->snippet->textOriginal}}</p>
						</div>

						<div class="col-lg-10 offset-lg-2">
							
						@if(isset($indiv_comment->replies))
						@foreach($indiv_comment->replies as $indiv_reply)
					
							@foreach($indiv_reply as $reply)
								<p class="reply_box rounded p-1 	">{{$reply->snippet->textDisplay}}</p>
							@endforeach
							
						@endforeach
						@endif
						</div>
						
					</div>
					@endforeach
			
				</div>
				{{-- <div class="col-lg-1"></div> --}}

			</div>
		</div>
	</div>
@endsection