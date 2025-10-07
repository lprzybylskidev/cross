<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield("title", config("app.name", "Laravel"))</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
    <style>
      .main-header.navbar {
        align-items: stretch;
      }
      .navbar-nav.ml-auto {
        flex: 0 0 auto;
      }
      .dropdown-menu .user-header {
        min-height: 150px;
      }
      .navbar-nav > .nav-item > .nav-link {
        padding-left: 0.6rem;
        padding-right: 0.6rem;
      }
    </style>
  </head>
  <body
    class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed dark-mode"
  >
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
        <ul class="navbar-nav m-0">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fas fa-bars"></i>
            </a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route("dashboard") }}" class="nav-link">Pulpit</a>
          </li>
          <li class="nav-item dropdown d-none d-sm-inline-block">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              Raporty
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Dzienne</a>
              <a class="dropdown-item" href="#">Miesięczne</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Roczne</a>
            </div>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Użytkownicy</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Ustawienia</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto align-items-center">
          <li class="nav-item">
            <a href="#" id="theme-toggle" class="nav-link" title="Zmień motyw">
              <i id="theme-icon" class="fas fa-moon"></i>
            </a>
          </li>
          <li class="nav-item dropdown user-menu ml-2">
            <a
              href="#"
              class="nav-link dropdown-toggle d-flex align-items-center"
              data-toggle="dropdown"
            >
              <i class="fas fa-user-circle fa-lg mr-2"></i>
              <div class="d-none d-md-block text-left">
                <div class="font-weight-bold">
                  {{ auth()->user()->name ?? "Użytkownik" }}
                </div>
                <div class="text-muted small">
                  {{ auth()->user()->email ?? "" }}
                </div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <li
                class="user-header bg-dark d-flex flex-column align-items-center justify-content-center text-center"
              >
                <i class="fas fa-user-circle fa-3x mb-2"></i>
                <p class="mb-0">{{ auth()->user()->name ?? "Użytkownik" }}</p>
                <small>{{ auth()->user()->email ?? "" }}</small>
              </li>
              <li class="user-footer bg-dark">
                <form method="POST" action="{{ route("logout") }}">
                  @csrf
                  <button type="submit" class="btn btn-danger btn-block">
                    Wyloguj
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route("dashboard") }}" class="brand-link">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 140 140"
            class="brand-image img-circle elevation-0 mx-2 flex-shrink-0"
            fill="currentColor"
            preserveAspectRatio="xMidYMid meet"
            style="width: 46px; height: 46px"
          >
            <circle cx="70" cy="10" r="7" />
            <circle cx="70" cy="130" r="7" />
            <circle cx="10" cy="70" r="7" />
            <circle cx="130" cy="70" r="7" />
            <circle cx="30" cy="30" r="7" />
            <circle cx="50" cy="30" r="7" />
            <circle cx="30" cy="50" r="7" />
            <circle cx="50" cy="50" r="7" />
            <circle cx="90" cy="30" r="7" />
            <circle cx="110" cy="30" r="7" />
            <circle cx="90" cy="50" r="7" />
            <circle cx="110" cy="50" r="7" />
            <circle cx="30" cy="90" r="7" />
            <circle cx="50" cy="90" r="7" />
            <circle cx="30" cy="110" r="7" />
            <circle cx="50" cy="110" r="7" />
            <circle cx="90" cy="90" r="7" />
            <circle cx="110" cy="90" r="7" />
            <circle cx="90" cy="110" r="7" />
            <circle cx="110" cy="110" r="7" />
          </svg>
          <span class="brand-text">{{ config("app.name", "Laravel") }}</span>
        </a>

        <div class="sidebar">
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
            >
              <li class="nav-item">
                <a
                  href="{{ route("dashboard") }}"
                  class="nav-link {{ request()->routeIs("dashboard") ? "active" : "" }}"
                >
                  <i class="nav-icon fas fa-home"></i>
                  <p>Pulpit</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                    Raporty
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dzienne</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Miesięczne</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Roczne</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Użytkownicy
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Uprawnienia</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>Ustawienia</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>

      <div class="content-wrapper">
        <section class="content p-2">
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                @php
                  $route = request()->route();
                  $name = $route?->getName();
                  $args = $route ? array_values($route->parameters()) : [];
                @endphp

                @if (empty($hideBreadcrumbs) && $name && \Diglactic\Breadcrumbs\Breadcrumbs::exists($name))
                  {!! \Diglactic\Breadcrumbs\Breadcrumbs::view("breadcrumbs::adminlte", $name, ...$args) !!}
                @endif
              </div>
            </div>

            @yield("content")
          </div>
        </section>
      </div>

      <footer class="main-footer text-sm">
        <div class="float-right d-none d-sm-inline">
          v. {{ env("APP_VERSION", "1.0.0") }}
        </div>
        <strong>
          &copy; {{ date("Y") }} {{ config("app.name", "Laravel") }}
        </strong>
      </footer>
    </div>

    <script>
      (function () {
        const key = 'theme';
        const body = document.body;
        const icon = document.getElementById('theme-icon');
        const mql = window.matchMedia('(prefers-color-scheme: dark)');
        function setIcon(mode) {
          if (mode === 'light') icon.className = 'fas fa-sun';
          else if (mode === 'system')
            icon.className = 'fas fa-circle-half-stroke';
          else icon.className = 'fas fa-moon';
        }
        function apply(mode) {
          if (mode === 'dark') body.classList.add('dark-mode');
          else if (mode === 'light') body.classList.remove('dark-mode');
          else body.classList.toggle('dark-mode', mql.matches);
          setIcon(mode);
        }
        function cycle(curr) {
          if (curr === 'dark') return 'light';
          if (curr === 'light') return 'system';
          return 'dark';
        }
        const saved = localStorage.getItem(key) || 'dark';
        apply(saved);
        const onSystemChange = () => {
          if ((localStorage.getItem(key) || 'dark') === 'system')
            apply('system');
        };
        mql.addEventListener
          ? mql.addEventListener('change', onSystemChange)
          : mql.addListener(onSystemChange);
        document
          .getElementById('theme-toggle')
          .addEventListener('click', (e) => {
            e.preventDefault();
            const next = cycle(localStorage.getItem(key) || 'dark');
            localStorage.setItem(key, next);
            apply(next);
          });
      })();
    </script>
  </body>
</html>
