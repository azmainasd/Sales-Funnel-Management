@extends('auth.layouts.app')

@section('main-content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
          <img src="{{ asset('admin-item/dist/img/sheba.png') }}" alt="sheba-icon" >
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        @if(Session::has('loginMessage'))
            <div  class="alert alert-danger">{{ session('loginMessage') }}</div> 
        @endif
  
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="row mb-2">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
          
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
@endsection
