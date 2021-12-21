@extends('login.master')
@php
    $title = "Login Kasin"
@endphp
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ asset('') }}assets/index2.html" class="h1 text-primary"><b style="color: orange">Kas</b>in</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="/login" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
                <p class="mb-0">
                    Dont Have Account? 
                </p>
                <a href="{{ route('register') }}" class="text-center">Register Here !</a>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4 mt-2">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.card-body -->
  </div>
@endsection