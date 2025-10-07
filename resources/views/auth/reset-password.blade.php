@extends('layouts.guest')

@section('title', 'Ustaw nowe hasło')

@section('content')
<div class="d-flex justify-content-center">
  <div class="card card-outline card-primary mt-4" style="max-width:480px;width:100%;">
    <div class="card-header text-center">
      <h1 class="h5 mb-0">Ustaw nowe hasło</h1>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group mb-3">
          <label for="email">Adres e-mail</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                   class="form-control @error('email') is-invalid @enderror"
                   required autofocus autocomplete="username" placeholder="adres@domena.pl">
          </div>
          @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group mb-3">
          <label for="password">Nowe hasło</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="new-password" placeholder="••••••••">
          </div>
          @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group mb-4">
          <label for="password_confirmation">Potwierdź hasło</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   required autocomplete="new-password" placeholder="••••••••">
          </div>
          @error('password_confirmation')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
          Zresetuj hasło
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
