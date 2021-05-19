@extends('layouts.base')
@section('title', 'Login Admin')

@section('content')
<div class="login-box">
    <div class="login-logo">
      <strong>Admin Login</strong>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="card-body login-card-body">
        <p class="login-box-msg"><strong>Sign in to start your session</strong></p>
        @error('email')
              <div class="alert alert-danger mt-2">
                {{ $message }}
              </div>
        @enderror
        @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="input-group mb-3">
            <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email / Username" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-circle"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="new-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-success float-right">
                    {{ __('Login') }}
                </button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1 mt-1">
          @if (Route::has('password.request'))
            <a class="btn btn-link text-success" href="{{ route('password.request') }}">
              <i>{{ __('Forgot Your Password?') }}</i>
            </a>
          @endif
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
@endsection
