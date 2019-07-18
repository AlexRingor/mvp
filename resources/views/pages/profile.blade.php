@extends ('template.template')

@section ("title", "Profile")

@section ("content")

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4">
			
			<div class="col-lg-12 mt-2">
				<div class="col-lg-12">
					<h1>{{$profile1->name}}</h1>
				</div>
				
				<div class="col-lg-12">
					<label for="email"><strong>Email</strong></label>
					<input class="form-control" type="text" name="email" value="{{$profile1->email}}" disabled>
				</div>
				<div class="col-lg-12 mt-3">
					<label for="youtube"><strong>Youtube ID</strong></label>
					<input class="form-control" type="text" name="youtube" value="{{$profile1->youtube}}" disabled> 
				</div>	
				

			</div>
			<div class="col-lg-12 mt-5">
				<form action="/submitArticle/{{$profile1->youtube}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="col-lg-12">
						<h1>Write Article</h1>
					</div>
					<div class="col-lg-12 mb-2">
						<input class="form-control" type="text" name="subject" value="Subject">
					</div>
					<div class="col-lg-12">
						<textarea class="form-control" name="content" id="" cols="30" rows="10">...</textarea>
					</div>	
					<div class="col-lg-6 mt-2">
						<button class="btn btn-primary">Post</button>
					</div>	
				</form>
			</div>
		</div>
		<div class="col-lg-4 mt-2">
			<h1>Articles</h1>
			<div class="col-lg-12" id="right_content_creator">

				@foreach($article as $indiv_article)
				<div class="container-fluid bg-dark m-2 pb-2">
					
				<h4 class="bg-dark text-light p-2 m-0" >Subject: {{$indiv_article->subject}}</h4>
				<small class="bg-dark text-light m-0 p- 1 "><strong>Uploaded: </strong>{{$indiv_article->created_at->diffForHumans()}}</small>
				<p class="bg-warning p-2"><strong>Content: </strong> {{$indiv_article->content}}</p>
				<small class="bg-danger">Status: {{$indiv_article->status}}</small><br>
				<button href="" data-toggle="modal" data-target="#c{{$indiv_article->id}}" class="btn no_background_color text-info"><i class="fas fa-edit"></i></button>
				<button href="" data-toggle="modal" data-target="#d{{$indiv_article->id}}" class="btn no_background_color text-danger"><i class="fas fa-trash-alt"></i></button>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="c{{$indiv_article->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<form action="/user/editArticle/{{$indiv_article->id}}" method="post" enctype="multipart/form-data">
									@csrf
									
								<input class="form-control" type="text" name="subject" value={{$indiv_article->subject}}>
							
							</div>
							<div class="modal-body">
								<textarea class="form-control" name="content" id="" cols="80" rows="10">{{$indiv_article->content}}</textarea>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn no_background_color text-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn no_background_color text-primary">Save changes</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				

				<!-- Modal -->
				<div class="modal fade" id="d{{$indiv_article->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">WARNING</h5>
								
							</div>
							<div class="modal-body">
								<h1 class="text-danger">Are you sure you want to delete {{$indiv_article->subject}}?</h1>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn no_background_color text-secondary" data-dismiss="modal">Close</button>
								<a href="/user/deleteArticle/{{$indiv_article->id}}" class="btn no_background_color text-danger">Delete</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>

		<div class="col-lg-4 mt-2">
			<h1>Feed </h1>
			@foreach($profile->items as $indiv_items)
				@if (Auth::user()->youtube===$indiv_items->id)
				<div class="col-lg-12">
					<form action="/user/post/{{Auth::user()->youtube}}" method="post" enctype="multipart/form-data">
						@csrf
						{{-- {{method_field('PATCH')}} --}}
						<div class="col-lg-12">
							<textarea class="rounded form-control" name="feed" id="" cols="50" rows="5"></textarea>
						</div>
						<div class="col-lg-12">						
							<button class="btn btn-primary">Post</button>
						</div>	
					</form>
				</div>
				@endif
				@endforeach


			@foreach($feed as $indiv_feed)
				<div class="col-lg-12">
					<p class="bg-warning mb-2 mt-2 p-2 rounded text-dark">{{$indiv_feed->comment}}</p>
				</div>
				<div class="col-lg-12">
					@foreach($profile->items as $indiv_items)
					@if (Auth::user()->youtube===$indiv_items->id)
					<div class="row">
						
					<div class="col-lg-1 offset-lg-9">
						
					<form action="/delete/post/{{$indiv_feed->id}}" method="post" enctype="multipart/form-data">
						@csrf
						<input class="form-control" type="hidden" name="youtube" value={{Auth::user()->youtube}}>
						{{-- <input type="hidden" name="youtube_id" value={{Auth::user()->id}}> --}}
						<button class="btn no_background_color text-danger"><i class="fas fa-trash-alt"></i></button>
					</form>
					</div>
					<div class="col-lg-2">
						
					<!-- Button trigger modal -->
					<button type="button" class="btn no_background_color text-info" data-toggle="modal" data-target="#call{{$indiv_feed->id}}">
						<i class="fas fa-edit"></i>
					</button>

					<!-- Modal -->
					<div class="modal fade" id="call{{$indiv_feed->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Edit post</h5>
										
								</div>
								<div class="modal-body">
									
									<form action="/user/editPost/{{Auth::user()->youtube}}" method="post" enctype="multipart/form-data">
							@csrf
									<input type="hidden" name="id" value={{$indiv_feed->id}}>
									<textarea class="form-control" name="edit_post" id="" cols="50" rows="5">{{$indiv_feed->comment}}</textarea>			
									<input type="hidden" name="youtube" value="{{Auth::user()->youtube}}">

						
						<button class="btn btn-danger">edit</button>
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
		</div>
	</div>

</div>

@endsection