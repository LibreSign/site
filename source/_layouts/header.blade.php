<header class="ud-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ $page->baseUrl . locale_path($page, '') }}">
              <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="Logo" />
            </a>
            <button class="navbar-toggler" title="{{$page->t("Toggle navigation menu")}}">
              <span class="toggler-icon"> </span>
              <span class="toggler-icon"> </span>
              <span class="toggler-icon"> </span>
            </button>

            <div class="navbar-collapse">
              <ul id="nav" class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ rtrim($page->baseUrl, '/') . locale_path($page, '') }}#home">{{$page->t("Home")}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ rtrim($page->baseUrl, '/') . locale_path($page, '') }}#features">{{$page->t("Features")}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ rtrim($page->baseUrl, '/') . locale_path($page, '') }}#about">{{ $page->t("About") }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ rtrim($page->baseUrl, '/') . locale_path($page, 'pricing') }}">{{ $page->t('Pricing')}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ rtrim($page->baseUrl, '/') . locale_path($page, '') }}#target_audience">{{ $page->t("Target audience") }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ rtrim($page->baseUrl, '/') . locale_path($page, '') }}#contact">{{ $page->t("Contact") }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ rtrim($page->baseUrl, '/') . locale_path($page, 'posts') }}">{{ $page->t("Posts") }}</a>
                </li>
                <li class="nav-item nav-item-has-children">
                  <a href="javascript:void(0)">{{ $page->t('Language') }}</a>
                  <ul class="ud-submenu">
                  @foreach($page->locales as $localeCode => $localeName)
                    <li class="ud-submenu-item">
                      <a class="ud-submenu-link" href="{{ rtrim($page->baseUrl, '/') . translate_url($page, $localeCode) }}">{{ $localeName }}</a>
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
