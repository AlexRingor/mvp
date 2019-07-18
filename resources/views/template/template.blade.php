<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta charset="UTF-8">
  {{-- GOOGLE FONTS --}}
  <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
  {{-- CUSTOM CSS --}}
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <link rel="stylesheet" href="{{asset('js/script.js')}}">
  <title>@yield("title")</title>
</head>
<body id="body">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="{{url('landingpage')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
  {{-- <a class="navbar-brand" href="{{url('landingpage')}}">MotovloggersPH{logo}</a> --}}
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('landingpage')}}">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{url('content_creators')}}">Content Creators</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{url('news')}}">News</a>
      </li>
        
  
      
         @auth
         @if(Auth::user()->role_id==3)
         <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage
        </a>
        <div class="dropdown-menu bg-dark text-white" aria-labelledby="navbarDropdown">
       {{--    <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a> --}}
          <a class="dropdown-item bg-dark text-white" href="/admin/manage">Users</a>
          <a class="dropdown-item bg-dark text-white" href="/admin/manageArticle">Articles</a>
        </div>
      </li>
         
          
         @endif
         <li class="nav-item">
          <a href="/profile/{{Auth::user()->youtube}}" class="nav-link">
          Welcome! {{Auth::user()->name}}!
          </a>
        </li>

      <li class="nav-item">
        <form action="/logout" method="post">
          @csrf
        <button class="nav-link btn btn-danger" href="/logout">Logout</button>
      </li>
        </form>
         @else
         <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="/register">Register</a>
        </li>
      @endauth
      
    </ul>
    
  </div>
</nav>

  @yield("content")

  <footer></footer>
  


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  {{-- fontawesome --}}
  <script src="https://kit.fontawesome.com/ca3ac3285e.js"></script>

  {{-- jquery cdn --}}
  <script
  src="https://code.jquery.com/jquery-3.4.1.slim.js"
  integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
  crossorigin="anonymous"></script>
</body>
</html>