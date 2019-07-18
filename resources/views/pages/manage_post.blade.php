@extends ('template.template')

@section ("title", "Profile")

@section ("content")
<div class="container" id="landingpage_scroll">
	<div class="row mt-5">
		{{-- pending --}}
		<div class="col-lg-12">
			<h4><strong>Pending Approval</strong></h4>
			<table class="table table-striped table-dark">
				<thead>
					<tr class="bg-info text-dark">
						<th scope="col">Title</th>
						<th scope="col">Author</th>
						<th scope="col">Date Posted</th>
						<th scope="col">Action</th>
					</tr>
					<tbody>
						@foreach($pending as $indiv_pending)
						<tr>

							<td>{{$indiv_pending->subject}}</td>
							<td>{{$indiv_pending->user->name}}</td>
							<td>{{$indiv_pending->created_at->diffForHumans()}}</td>
							<td><a href="" data-toggle="modal" data-target="#c{{$indiv_pending->id}}">Review</a>
								<!-- Modal -->
								<div class="modal fade" id="c{{$indiv_pending->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title text-dark" id="exampleModalLabel">{{$indiv_pending->subject}}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<small class="text-dark">By {{$indiv_pending->user->name}}</small>
												<small class="text-dark">Uploaded {{$indiv_pending->created_at->diffForHumans()}}</small>
												<p class="text-dark">{{$indiv_pending->content}}</p>
											</div>
											<div class="modal-footer">
												<a href="/admin/approvePost/{{$indiv_pending->id}}">Approve</a>
												<a href="/admin/rejectPost/{{$indiv_pending->id}}">Reject</a>
												<a href="" data-dismiss>Close</a>
											</div>
										</div>
									</div>
								</div></td>
							</tr>
							@endforeach
						</tbody>
					</thead>
				</table>
			</div>
			{{-- approved --}}
			<div class="col-lg-12">
				<h4><strong>Approved</strong></h4>
				<table class="table table-striped table-dark">
					<thead>
						<tr class="bg-success">
							<th scope="col">Title</th>
							<th scope="col">Author</th>
							<th scope="col">Date Posted</th>
							<th scope="col">Action</th>
						</tr>
						<tbody>
							@foreach($approved as $indiv_approve)
							<tr>

								<td>{{$indiv_approve->subject}}</td>
								<td>{{$indiv_approve->user->name}}</td>
								<td>{{$indiv_approve->created_at->diffForHumans()}}</td>
								<td><a href="" data-toggle="modal" data-target="#c{{$indiv_approve->id}}">Review</a>
								<!-- Modal -->
								<div class="modal fade" id="c{{$indiv_approve->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title text-dark" id="exampleModalLabel">{{$indiv_approve->subject}}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<small class="text-dark">By {{$indiv_approve->user->name}}</small>
												<small class="text-dark">Uploaded {{$indiv_approve->created_at->diffForHumans()}}</small>
												<p class="text-dark">{{$indiv_approve->content}}</p>
											</div>
											<div class="modal-footer">
												<a href="/admin/rejectPost/{{$indiv_approve->id}}">Takedown</a>
												
												<a href="" data-dismiss>Close</a>
											</div>
										</div>
									</div>
								</div></td>
							</tr>
							@endforeach
						</tbody>
					</thead>
				</table>
			</div>
			{{-- rejected --}}
			<div class="col-lg-12">
				<h4><strong>Rejected</strong></h4>
				<table class="table table-striped table-dark">
					<thead >
						<tr class="bg-danger text-white">
							<th scope="col">Title</th>
							<th scope="col">Author</th>
							<th scope="col">Date Posted</th>
							<th scope="col">Action</th>
						</tr>
						<tbody>
							@foreach($rejected as $indiv_rejected)
							<tr>

								<td>{{$indiv_rejected->subject}}</td>
								<td>{{$indiv_rejected->user->name}}</td>
								<td>{{$indiv_rejected->created_at->diffForHumans()}}</td>
								<td><a href="" data-toggle="modal" data-target="#c{{$indiv_rejected->id}}">Review</a>
								<!-- Modal -->
								<div class="modal fade" id="c{{$indiv_rejected->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title text-dark" id="exampleModalLabel">{{$indiv_rejected->subject}}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<small class="text-dark">By {{$indiv_rejected->user->name}}</small>
												<small class="text-dark">Uploaded {{$indiv_rejected->created_at->diffForHumans()}}</small>
												<p class="text-dark">{{$indiv_rejected->content}}</p>
											</div>
											<div class="modal-footer">
												<a href="/admin/approvePost/{{$indiv_rejected->id}}">Approve</a>
												<a href="/admin/pendingPost/{{$indiv_rejected->id}}">For Review</a>
												<a href="" data-dismiss>Close</a>
											</div>
										</div>
									</div>
								</div></td>
							</tr>
							@endforeach
						</tbody>
					</thead>
				</table>
			</div>	

		</div>
	</div>
	@endsection
