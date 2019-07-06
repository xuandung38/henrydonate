@extends('layouts.auth')

@section('content')
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">{{ __('Login') }}</h5>
               @if(session()->has('login_error'))
                <div class="alert alert-success ">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session()->get('login_error') }}
                </div>
              @endif
            <form class="form-signin" method="POST" action="{{ route('login') }}">
               @csrf
                <div class="form-group">                
                    <label for="identity">{{ __('Username or E-Mail Address') }}</label>
                    <input id="identity" type="text" class="form-control{{ $errors->has('identity') ? ' is-invalid' : '' }}" name="identity" value="{{ old('identity') }}" required autofocus>
                        @if ($errors->has('identity'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('identity') }}</strong>
                            </span>
                        @endif
                </div>              
                <div class="form-group">                    
                    <label for="password" >{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

              <div class="custom-control custom-checkbox mb-3">
                <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
              </div>              
                <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase"> {{ __('Login') }}</button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif                           

              <hr class="my-4">
              <a class="btn btn-lg btn-google btn-block text-uppercase" href="{{ route('register') }}"><i class="fas fa-registered mr-2"></i>Đăng ký</a>
              <a class="btn btn-lg btn-facebook btn-block text-uppercase" href="{{ route('sociallogin','facebook') }}"><i class="fab fa-facebook-f mr-2"></i> Đăng nhập bàng fb</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
@endsection
