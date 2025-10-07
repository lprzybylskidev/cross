@props([
  "breadcrumbs",
])

@if (count($breadcrumbs))
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent px-0 py-2 mb-2 text-sm">
      @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && ! $loop->last)
          <li class="breadcrumb-item">
            <a href="{{ $breadcrumb->url }}" class="text-reset">
              @if ($loop->first)
                <i class="fas fa-home mr-1"></i>
              @endif

              {{ $breadcrumb->title }}
            </a>
          </li>
        @else
          <li class="breadcrumb-item active" aria-current="page">
            @if ($loop->first)
              <i class="fas fa-home mr-1"></i>
            @endif

            {{ $breadcrumb->title }}
          </li>
        @endif
      @endforeach
    </ol>
  </nav>
@endif
