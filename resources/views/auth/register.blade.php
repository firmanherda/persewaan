@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
          <div class="login-brand">
            <img src="{{ asset("storage/img/logo.jpg") }}" alt="logo" width="100" class="shadow-light rounded-circle">
          </div>

          <div class="card card-primary">
            <div class="card-header">
              <h4>Register</h4>
            </div>

            <div class="card-body">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                    autofocus>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <input id="password" type="password"
                      class="form-control pwstrength @error('password') is-invalid @enderror" data-indicator="pwindicator"
                      name="password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label for="password_confirmation" class="d-block">Password Confirmation</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                  </div>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <div class="invalid-feedback">
                  </div>
                </div>
                <div class="form-group">
                  <label for="no_hp">No HP</label>
                  <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp">
                  @error('no_hp')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <div class="invalid-feedback">
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">
                  @error('alamat')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <div class="invalid-feedback">
                  </div>
                </div>

{{--
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                    <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                  </div>
                </div> --}}

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="simple-footer">
            Copyright &copy; Stisla 2018
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
