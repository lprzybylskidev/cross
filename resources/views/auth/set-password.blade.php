@extends("layouts.guest")

@section("title", "Ustaw hasło")

@section("content")
  <div class="d-flex justify-content-center">
    <div
      class="card card-outline card-primary mt-4"
      style="max-width: 480px; width: 100%"
    >
      <div class="card-header text-center">
        <h1 class="h4 mb-0">Ustaw hasło</h1>
      </div>

      <div class="card-body">
        @if (session("status"))
          <div class="alert alert-success mb-3" role="alert">
            {{ session("status") }}
          </div>
        @endif

        @if (session("error"))
          <div class="alert alert-danger mb-3" role="alert">
            {{ session("error") }}
          </div>
        @endif

        <form
          method="POST"
          action="{{ route("password.set.store") }}"
          novalidate
        >
          @csrf

          <div class="form-group mb-3">
            <label for="password">Nowe hasło</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-lock"></i>
                </span>
              </div>
              <input
                id="password"
                type="password"
                name="password"
                class="form-control @error("password") is-invalid @enderror"
                required
                autocomplete="new-password"
                placeholder="••••••••"
              />
            </div>
            @error("password")
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="password_confirmation">Powtórz hasło</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-lock"></i>
                </span>
              </div>
              <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="form-control"
                required
                autocomplete="new-password"
                placeholder="••••••••"
              />
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block">
            Zapisz hasło
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
