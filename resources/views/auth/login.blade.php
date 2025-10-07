@extends('layouts.guest')

@section('title', 'Logowanie')

@section('content')
<div class="d-flex justify-content-center">
  <div class="card card-outline card-primary mt-4" style="max-width:480px;width:100%;">
    <div class="card-header text-center">
      <h1 class="h4 mb-0">Logowanie</h1>
    </div>
    <div class="card-body">
      @if(session('status'))
        <div class="alert alert-success mb-3" role="alert">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="form-group mb-3">
          <label for="email">Email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   required autofocus autocomplete="username" placeholder="adres@domena.pl">
          </div>
          @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="form-group mb-3">
          <label for="password">Hasło</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password" placeholder="••••••••">
          </div>
          @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="form-group mb-3">
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-check m-0">
              <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
              <label class="form-check-label" for="remember_me">Zapamiętaj mnie</label>
            </div>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="small">Nie pamiętasz hasła?</a>
            @endif
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
      </form>
    </div>
  </div>
</div>
@endsection

