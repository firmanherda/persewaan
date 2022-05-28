@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="login-brand">
            <img src="{{ asset("storage/img/logo.jpg") }}" alt="logo" width="100" class="shadow-light rounded-circle">

          </div>

          <div class="card card-primary">
            <div class="card-header"><h4>Login</h4></div>

            <div class="card-body">
              <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control form-control-user  @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" id="email" aria-describedby="emailHelp"
                    placeholder="">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    <div class="float-end">
                      <a href="auth-forgot-password.html" class="text-small">
                        Forgot Password?
                      </a>
                    </div>
                  </div>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required>
                  <div class="invalid-feedback" required autocomplete="password">
                   @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                {{-- <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                  </div>
                </div> --}}

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                  </button>
                </div>
              </form>

            </div>
          </div>
          <div class="mt-5 text-muted text-center">
            Don't have an account? <a href="{{ route('register') }}">Register   </a>
          </div>
          <div class="simple-footer">
            Copyright &copy; Alat Camping Go On
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
