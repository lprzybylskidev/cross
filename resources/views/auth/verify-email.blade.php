@extends('layouts.guest')

@section('title', 'Weryfikacja e-mail')

@section('content')
<div class="d-flex justify-content-center">
  <div class="card card-outline card-primary mt-4" style="max-width:560px;width:100%;">
    <div class="card-header text-center">
      <h1 class="h5 mb-0">Potwierdź adres e-mail</h1>
    </div>

    <div class="card-body">
      <p class="text-muted">
        Dziękujemy za rejestrację! Zanim zaczniemy, potwierdź swój adres e-mail, klikając w link, który właśnie wysłaliśmy. Jeśli nie otrzymałeś wiadomości, możemy wysłać ją ponownie.
      </p>

      @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success" role="alert">
          Nowy link weryfikacyjny został wysłany na adres e-mail podany podczas rejestracji.
        </div>
      @endif

      <div class="d-flex align-items-center justify-content-between mt-3">
        <form method="POST" action="{{ route('verification.send') }}">
          @csrf
          <button type="submit" class="btn btn-primary">Wyślij ponownie link weryfikacyjny</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-secondary">Wyloguj</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
