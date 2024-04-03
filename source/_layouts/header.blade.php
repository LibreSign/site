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
                <li class="nav-item nav-item-has-children">
                  <a href="javascript:void(0)">Language</a>
                  <ul class="ud-submenu">
                  @foreach(['' => 'English','pt-BR' => 'Português'] as $localeCode => $localeName)
                    <li class="ud-submenu-item">
                      <a class="ud-submenu-link" href="{{ translate_path($page, $localeCode) }}">{{ $localeName }}</a>
                    </li>
                  @endforeach
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
</header>