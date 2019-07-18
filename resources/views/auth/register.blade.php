@extends('template.template_no_navbar')

@section ("title", "MVPH: Register")

@section('content')
<div class="container-fluid login" >
    <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
            <div class="card remove_white text-white border-0">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="youtube" class="col-md-4 col-form-label text-md-right">Channel-ID</label>

                            <div class="col-md-6 mt">
                                <input id="youtube" type="text" class="form-control" name="youtube" required>
                                <a class="link mt-5" data-toggle="modal" data-target="#exampleModal" href="">How to retrieve channel ID</a>



                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content text-dark">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Find your YouTube user & channel IDs</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <small>Each YouTube channel has a unique user ID and channel ID. These are used to refer to the channel in certain apps and services.

                                    </small>
                                    <img src="{{asset('images/youtube_help.png')}}" alt="">
                                    <h4>Find your channel's user ID & channel ID</h4>
                                    <p>You can see your channel's user and channel IDs in your advanced <a href="http://www.youtube.com/account_advanced">account settings</a></p>
                                    <ol>
                                        <li>Sign in to your YouTube account.</li>
                                        <li>In the top right, click your account icon > settings Settings. <i class="fas fa-cog"></i> </li>
                                        <li>Next to your profile photo, click Advanced.</li>
                                        <li>You'll see your channel's user and channel IDs under "Account information."</li>
                                    </ol>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-dark">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
            <div class="form-group row mb-0 mt-5">
                <div class="col-md-8 offset-md-4">
                    <a href="{{url('login')}}" class="form-check-label link">Already Registered? Click here to Login


                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
