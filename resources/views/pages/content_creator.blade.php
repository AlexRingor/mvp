@extends ('template.template')

@section ("title", "Content-Creator")

@section ("content")
<div class="container-fluid" id="content_creator">
	<div class="row">
		<div class="col-lg-8" id="left_content_creator">
			<div class="col-lg-12 text-center">
				{{-- @if(isset($profile)) --}}
				@foreach($profile->items as $indiv_items)
				<h1>{{$indiv_items->brandingSettings->channel->title}}</h1>
				<img class="img-fluid" src="{{$indiv_items->brandingSettings->image->bannerImageUrl}}" alt="">
			</div>
			<div class="col-lg-12 p-2">
				<h6><strong>{{$indiv_items->brandingSettings->channel->description}}</strong></h6>
			</div>
				@endforeach
				{{-- @endif --}}
		
			<div class="row">
				@foreach($result->items as $indiv_result)
				
				<div class="col-lg-4 col-sm-6 mt-2 text-center">
					@if(isset($indiv_result->id->videoId))
					<a href="/video/{{$indiv_result->id->videoId}}">
						<img class="img-fluid" src="{{$indiv_result->snippet->thumbnails->medium->url}}" alt="">
						<h6 class="text-white">{{$indiv_result->snippet->title}}</h6>
					</a>
					
					@endif
				</div>
				@endforeach
			</div>

		</div>
		@auth
		<div class="col-lg-4 feed-bg" id="right_content_creator">
			<h1>Feed</h1>

			@foreach($profile->items as $indiv_items)
			@if (Auth::user()->youtube===$indiv_items->id)
			<div class="col-lg-12">
				<form action="/user/post/{{Auth::user()->youtube}}" method="post" enctype="multipart/form-data">
					@csrf
					{{-- {{method_field('PATCH')}} --}}
					<div class="col-lg-12">
						<textarea class="rounded" name="feed" id="" cols="50" rows="5"></textarea>
					</div>
					<div class="col-lg-12">						
						<button class="btn text-primary">Post</button>
					</div>	
				</form>
			</div>
			@endif
			@endforeach
			{{-- @endauth --}}
			@foreach($feed as $indiv_feed)
			<div class="col-lg-12">

				<p class="bg-warning mb-2 mt-2 p-2 rounded text-dark">{{$indiv_feed->comment}} <a href="" data-toggle="modal" data-target="#user{{$indiv_feed->id}}"><i class="fas fa-reply"></i></a></p>
				<div class="modal fade" id="user{{$indiv_feed->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content bg-dark">
							<div class="modal-header">
								<p class="modal-title" id="exampleModalLabel">{{$indiv_feed->comment}}</p>

								
							</div>
							<form action="/user/reply" method="post" enctype="multipart/form-data">
								@csrf
								<div class="modal-body">
									<textarea class="form-control" name="reply" id="" cols="45" rows="5"></textarea>
								</div>
								<div class="modal-footer">
									<button  type="button" class="btn no_background_color text-danger" data-dismiss="modal"><i class="far fa-window-close"></i></button>
									<input type="hidden" name="comment_id" value={{$indiv_feed->id}}>
									<input type="hidden" name="user_id" value="{{Auth::user()->id}}">


									<button type="submit" class="btn no_background_color text-success"><i class="far fa-paper-plane"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>

				@foreach ($feed_replies as $indiv_reply)

				@if ($indiv_feed->id === $indiv_reply->comment_id)
				<div class="col-lg-8 offset-lg-4 reply_box text-dark rounded">
					<small>{{$indiv_reply->user->name}}</small>
					<p>{{$indiv_reply->reply}}<a href="" data-toggle="modal" data-target="#c{{$indiv_reply->id}}"> 	  @if(Auth::user()->id !== $indiv_reply->user_id)
						<i class="fas fa-reply"></i>
						@endif
					</a></p>
					@if(Auth::user()->id === $indiv_reply->user_id)
					<a class="edit mt-2" href="" data-toggle="modal" data-target="#edits{{$indiv_reply->id}}"><small><i class="fas fa-edit"></i></small></a>
					<!-- Modal -->
					<div class="modal fade" id="edits{{$indiv_reply->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content bg-dark text-white">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Edit comment</h5>

								</div>
								<form action="/user/editPostComment/{{$indiv_reply->id}}" method="post" enctype="multipart/form-control">
									@csrf
									<div class="modal-body">

										<textarea class="form-control" name="edit_reply" id="" cols="30" rows="2">{{$indiv_reply->reply}}</textarea>													</div>
										<div class="modal-footer">
											<button type="button" class="btn no_background_color text-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
											<button type="submit" class="btn no_background_color text-primary"><i class="fas fa-paper-plane"></i></button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<a class="delete mt-2" href="/user/deletecommentfromfeed/{{$indiv_reply->id}}"><small><i class="fas fa-trash"></i></small></a>
						@endif
						<!-- Modal -->
						<div class="modal fade" id="c{{$indiv_reply->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content bg-dark text-white">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Replying to {{$indiv_reply->user->name}}'s comment</h5>

									</div>
									<form action="/user/reply" method="post" enctype="multipart/form-data">
										@csrf

										<div class="modal-body">
											<textarea class="form-control" name="reply" id="" cols="45" rows="5">@ {{$indiv_reply->user->name}}</textarea>
											<input type="hidden" name="user_id" value={{Auth::user()->id}}>
											<input type="hidden" name="comment_id" value={{$indiv_feed->id}}>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn text-secondary" data-dismiss="modal"><i class="far fa-window-close"></i></button>

											<button type="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i></button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					@endif
					@endforeach

				</div>
				<div class="col-lg-12 mt-2">
					@foreach($profile->items as $indiv_items)
					@if (Auth::user()->youtube===$indiv_items->id)
					<div class="row">

						<div class="col-lg-1 offset-lg-9">

							<form action="/delete/post/{{$indiv_feed->id}}" method="post" enctype="multipart/form-data">
								@csrf
								<input class="form-control" type="hidden" name="youtube" value={{Auth::user()->youtube}}>
								{{-- <input type="hidden" name="youtube_id" value={{Auth::user()->id}}> --}}
								<button class="btn text-danger no_background_color"><i class="fas fa-trash-alt"></i></button>
							</form>
						</div>
						<div class="col-lg-2">

							<!-- Button trigger modal -->
							<button type="button" class="btn no_background_color text-primary" data-toggle="modal" data-target="#call{{$indiv_feed->id}}">
								<i class="fas fa-edit"></i>
							</button>

							<!-- Modal -->
							<div class="modal fade" id="call{{$indiv_feed->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content bg-dark text-white">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edit post</h5>

										</div>
										<div class="modal-body">

											<form action="/user/editPost/{{Auth::user()->youtube}}" method="post" enctype="multipart/form-data">
												@csrf
												<input class="form-control" type="hidden" name="id" value={{$indiv_feed->id}}>
												<textarea class="form-control" name="edit_post" id="" cols="50" rows="5">{{$indiv_feed->comment}}</textarea>			
												<input class="form-control" type="hidden" name="youtube" value="{{Auth::user()->youtube}}">


												<button class="btn no_background_color text-danger mt-2">edit</button>
											</form>
										</div>
									{{-- </div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach
			</div>
			@endforeach
		{{-- </div> --}}
	</div>
	@endauth	
</div>		
</div>
@endsection