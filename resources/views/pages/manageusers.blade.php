@extends ('template.template')

@section ("title", "Profile")

@section ("content")

<div class="container">
		<h4>Admin</h4>
		<table class="table table-striped table-dark">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Youtube-ID</th>
	      {{-- <th scope="col">Role</th> --}}
	      {{-- <th scope="col">RoleChange</th> --}}
	    </tr>
  </thead>
  <tbody>
	@foreach($admin as $indiv_admin)
    <tr>
      <th scope="row">{{$indiv_admin->id}}</th>
      <td>{{$indiv_admin->name}}</td>
      <td>{{$indiv_admin->email}}</td>
      <td>{{$indiv_admin->youtube}}</td>
      {{-- <td>{{$indiv_admin->role->name}}</td> --}}
      @if($indiv_admin->role_id === 1)
			<td>
				<button class="btn btn-info">Test</button>
				<button class="btn btn-info"><i class="fas fa-users-cog"></i></button>
				<button class="btn btn-danger">X</button>
			</td>
	  @elseif ($indiv_admin->role_id === 2)
	  		<td>
	  			<button class="btn btn-info"><i class="fas fa-users"></i></button>
	  			<button class="btn btn-info"><i class="fas fa-users-cog"></i></button>
	  			{{-- <button class="btn btn-danger">X</button> --}}
	  		</td>
	  @elseif ($indiv_admin->role_id === 3)
	  		@if($indiv_admin->id === 6)

	  		@else
	  		<td>
	  			<a href="/admin/demoteToViewer/{{$indiv_admin->youtube}}" class="btn btn-info"><i class="fas fa-users"></i></a>
	  		</td>
	  		
	  		@endif
      @endif

    </tr>
	@endforeach
</tbody>
</table>
	

		<h4>Content Creators</h4>
	<table class="table table-striped table-dark">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Youtube-ID</th>
	      
	      <th scope="col">RoleChange</th>
	    </tr>
  </thead>
  <tbody>
	@foreach($contentCreator as $indiv_viewer)
    <tr>
      <th scope="row">{{$indiv_viewer->id}}</th>
      <td>{{$indiv_viewer->name}}</td>
      <td>{{$indiv_viewer->email}}</td>
      <td>{{$indiv_viewer->youtube}}</td>
    
      @if($indiv_viewer->role_id === 1)
			<td>
				<button class="btn btn-info"><i class="fab fa-youtube"></i></button>
				<button class="btn btn-info"><i class="fas fa-users-cog"></i></button>
				
			</td>
	  @elseif ($indiv_viewer->role_id === 2)
	  		<td>
	  			<a href="/admin/demoteToViewer/{{$indiv_viewer->youtube}}" class="btn btn-info"><i class="fas fa-users"></i></a>
	  			<a href="/admin/makeAdmin/{{$indiv_viewer->youtube}}" class="btn btn-info"><i class="fas fa-users-cog"></i></a>
	  			{{-- <button class="btn btn-danger">X</button> --}}
	  		</td>
	  @elseif ($indiv_viewer->role_id === 3)
	  		<td></td>
      @endif

    </tr>
	@endforeach
</tbody>
</table>
	<h4>Viewers</h4>
	<table class="table table-striped table-dark">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Youtube-ID</th>
	      
	      <th scope="col">RoleChange</th>
	    </tr>
  </thead>
  <tbody>
	@foreach($viewer as $indiv_viewer)
    <tr>
      <th scope="row">{{$indiv_viewer->id}}</th>
      <td>{{$indiv_viewer->name}}</td>
      <td>{{$indiv_viewer->email}}</td>
      <td>{{$indiv_viewer->youtube}}</td>
    
      @if($indiv_viewer->role_id === 1)
			<td>
				<a href="/admin/makeViewerContentCreator/{{$indiv_viewer->youtube}}" class="btn btn-info"><i class="fab fa-youtube"></i></a>
				<a href="/admin/makeAdmin/{{$indiv_viewer->youtube}}" class="btn btn-info"><i class="fas fa-users-cog"></i></a>
				<a href="/admin/deleteUser/{{$indiv_viewer->youtube}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
			</td>
	  @elseif ($indiv_viewer->role_id === 2)
	  		<td>
	  			<button class="btn btn-info"><i class="fas fa-users"></i></button>
	  			<button class="btn btn-info"><i class="fas fa-users-cog"></i></button>
	  			{{-- <button class="btn btn-danger">X</button> --}}
	  		</td>
	  @elseif ($indiv_viewer->role_id === 3)
	  		<td></td>
      @endif

    </tr>
	@endforeach
</tbody>
</table>
</div>

@endsection