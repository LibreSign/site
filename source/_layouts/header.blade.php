<header class="ud-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ $page->baseUrl }}">
              <img src="{{ $page->baseUrl }}assets/images/logo/logo.png" alt="Logo" />
            </a>
            <button class="navbar-toggler">
              <span class="toggler-icon"> </span>
              <span class="toggler-icon"> </span>
              <span class="toggler-icon"> </span>
            </button>

            <div class="navbar-collapse">
              <ul id="nav" class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#home">{{__($page,"Home",current_path_locale($page))}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#features">{{__($page,"Features",current_path_locale($page))}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#about">{{ __($page,"About",current_path_locale($page)) }}</a>
                </li>
                {{-- <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#pricing">Pricing</a>
                </li> --}}
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#target_audience">{{ __($page,"Target Audience",current_path_locale($page)) }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#contact">{{ __($page,"Contact",current_path_locale($page)) }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}posts">{{ __($page,"Posts",current_path_locale($page)) }}</a>
                </li>
                <li class="nav-item">
                  @foreach(['en','pt-BR'] as $locale)
                    <a href="{{ translate_path($page, $locale) }}">{{ $locale }}</a>
                  @endforeach
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
</header>