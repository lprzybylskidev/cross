@extends('layouts.guest')

@section('title', 'Reset hasła')

@section('content')
<div class="d-flex justify-content-center">
  <div class="card card-outline card-primary mt-4" style="max-width:480px;width:100%;">
    <div class="card-header text-center">
      <h1 class="h5 mb-0">Reset hasła</h1>
    </div>

    <div class="card-body">
      <p class="text-muted mb-4">
        Zapomniałeś hasła? Nie ma problemu. Podaj adres e-mail, a wyślemy Ci link do zresetowania hasła.
      </p>

      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group mb-3">
          <label for="email">Adres e-mail</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   required autofocus placeholder="adres@domena.pl">
          </div>
          @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
          Wyślij link resetujący hasło
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
