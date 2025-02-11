@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-box">
  <div class="text-center mb-4">
    <img src="{{ asset('logo.png') }}" alt="RHC Logo" class="img-fluid" style="max-height: 100px;">
  </div>

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h2><b>RHC</b> HRMS</h2>
    </div>
    <div class="card-body login-card-body">
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif
      <form id="login-form" method="POST" action="">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="login" class="form-control" placeholder="Email or Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block" id="login-button">Sign In</button>
          </div>
        </div>
      </form>
      <div id="loading-animation" class="text-center mt-3" style="display: none;">
        <span class="spinner-border spinner-border-sm text-success" role="status" aria-hidden="true"></span>
        <span>Redirecting...</span>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const loginButton = document.getElementById('login-button');
    const loadingAnimation = document.getElementById('loading-animation');

    loginForm.addEventListener('submit', function (event) {
      event.preventDefault();
      loginButton.disabled = true
      loadingAnimation.style.display = 'block';

      setTimeout(() => {
        loginForm.submit(); // Submit the form after a short delay
      }, 1000);
    });
  });
</script>
@endsection
