@extends('layouts.guest')

@section('title', 'Potwierdź hasło')

@section('content')
<div class="d-flex justify-content-center">
  <div class="card card-outline card-primary mt-4" style="max-width:480px;width:100%;">
    <div class="card-header text-center">
      <h1 class="h5 mb-0">Potwierdź hasło</h1>
    </div>

    <div class="card-body">
      <p class="text-muted mb-4">
        To jest chroniony obszar aplikacji. Proszę potwierdź swoje hasło przed kontynuowaniem.
      </p>

      <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

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
          @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Potwierdź</button>
      </form>
    </div>
  </div>
</div>
@endsection
