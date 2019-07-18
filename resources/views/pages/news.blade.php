@extends('template.template')

@section ("title", "MotovloggersPH")

@section ("content")
	
	<div class="container" id="landingpage_scroll">
		<?php
				$count = 0;
				?>
		<div class="row">
			
		@foreach($article as $indiv_article)
				<div class="col-lg-12 pb-3
				@if($count % 2 == 0)
				bg-dark
				text-light
				@else
				bg-warning
				text-dark
				@endif

				" style="
				padding-left: 0px;">
				{{-- @foreach($indiv_approved_post->items as $i) --}}
				
				
				
				<!-- Button trigger modal -->
				<a class="news" data-toggle="modal" data-target="#news{{$indiv_article->id}}">
					
				

				<!-- Modal -->
				

				<div class="col-lg-12 pt-3 pb-3>">
					<h3>{{$indiv_article->subject}}</h3>
					<small>By: {{$indiv_article->user->name}}</small>
					<small>{{$indiv_article->created_at->diffForHumans()}}</small>
				</div>
				<div class="col-lg-12">


					<p class="mb-0">{{$indiv_article->content}}</p>

				</div>
				</a>

				<div class="modal fade bg-dark text-white" id="news{{$indiv_article->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content bg-dark border-0">
							<div class="modal-header">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="modal-title" id="exampleModalLabel">{{$indiv_article->subject}}</h4>
									</div>
									<div class="col-lg-12">
										<small>By: {{$indiv_article->user->name}}</small>
									</div>
									<div class="col-lg-12">
										<small>{{$indiv_article->created_at->diffForHumans()}}</small>
										
									</div>
										
								</div>
								
								
							</div>
							<div class="modal-body">
								<p class="mb-0">{{$indiv_article->content}}</p>
							</div>
							<div class="modal-footer">
								<form action="/user/addCommentToPost" method="Post" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-lg-10 m-0 pr-3">
								<textarea class="form-control" name="reply" id="" cols="50" rows="2"></textarea>
											
										</div>
									<div class="col-lg-1 m-0 p-0">
										
								<button type="submit" class="btn no_background_color text-success"><i class="fas fa-reply"></i></button>
									</div>
									<div class="col-lg-1 m-0 p-0">

										<input type="hidden" name="post_id" value={{$indiv_article->id}}>
										<input type="hidden" name="user_id" value={{Auth::user()->id}}>
										
								<button class="btn no_background_color text-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
									</div>
									</div>
									
								</form>
							</div>
							<div class="div">
								<h6><strong>Comments: </strong></h6>
								<div class="row">
									
								@foreach($post_comment as $indiv_post_comment)
								@if($indiv_post_comment->post_id === $indiv_article->id)
								<div class="col-lg-10 offset-lg-1 bg-warning mt-2 pt-3 text-dark rounded">
									<a href="/user/viewprofile/{{$indiv_post_comment->user->youtube}}"><h6>{{$indiv_post_comment->user->name}}</h6></a>
									<small>{{$indiv_post_comment->created_at->diffForHumans()}}</small>
									<p>{{$indiv_post_comment->reply}}</p>
									@if(Auth::user()->id === $indiv_post_comment->user_id)
										<a class="edit" href="" data-toggle="modal" data-target="#edit{{$indiv_post_comment->id}}"><small><i class="fas fa-edit"></i></small></a>
										<!-- Modal -->
										<div class="modal fade" id="edit{{$indiv_post_comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit comment</h5>
														
													</div>
														<form action="/user/editcomment/{{$indiv_post_comment->id}}" method="post" enctype="multipart/form-control">
															@csrf
													<div class="modal-body">
															
														<textarea class="form-control" name="edit_reply" id="" cols="30" rows="2">{{$indiv_post_comment->reply}}</textarea>													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
														<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
													</div>
														</form>
												</div>
											</div>
										</div>
										<a class="delete" href="/user/deletecomment/{{$indiv_post_comment->id}}"><small><i class="fas fa-trash"></i></small></a>
										@endif

								</div>
								@endif
								@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				{{-- @endforeach --}}
				
				
			</div>
			<?php $count++; ?>
			{{-- @endforeach --}}
			@endforeach
		</div>
	</div>

@endsection