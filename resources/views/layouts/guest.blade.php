<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield("title", config("app.name", "Laravel"))</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>
  <body class="hold-transition dark-mode">
    <div class="wrapper">
      <button
        id="theme-toggle"
        class="btn btn-outline-secondary btn-sm position-fixed m-3"
        style="top: 0; left: 0"
        title="Zmień motyw"
      >
        <i id="theme-icon" class="fas fa-moon"></i>
      </button>

      <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="container" style="max-width: 520px">
          <div class="mb-4">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 140 140"
              fill="currentColor"
              preserveAspectRatio="xMidYMid meet"
              class="d-block mx-auto brand-logo"
              style="width: 250px; height: 250px"
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
          </div>

          @yield("content")
        </div>
      </div>

      <div class="position-fixed w-100 text-center pb-3" style="bottom: 0">
        <span>
          &copy; {{ date("Y") }} {{ config("app.name", "Laravel") }}
        </span>
      </div>
    </div>

    <script>
      (function () {
        const key = 'theme';
        const body = document.body;
        const icon = document.getElementById('theme-icon');
        const logo = document.querySelector('.brand-logo');
        const mql = window.matchMedia('(prefers-color-scheme: dark)');
        function setIcon(mode) {
          if (mode === 'light') icon.className = 'fas fa-sun';
          else if (mode === 'system')
            icon.className = 'fas fa-circle-half-stroke';
          else icon.className = 'fas fa-moon';
        }
        function setLogo(mode) {
          if (mode === 'light') logo.classList.add('text-primary');
          else if (mode === 'dark') logo.classList.remove('text-primary');
          else logo.classList.toggle('text-primary', !mql.matches);
        }
        function apply(mode) {
          if (mode === 'dark') body.classList.add('dark-mode');
          else if (mode === 'light') body.classList.remove('dark-mode');
          else body.classList.toggle('dark-mode', mql.matches);
          setIcon(mode);
          setLogo(mode);
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
