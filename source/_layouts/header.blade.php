<header class="ud-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ locale_path($page, $page->baseUrl) }}">
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
                  <a class="ud-menu-scroll" href="{{ locale_path($page, $page->baseUrl) }}#home">{{$page->t("Home")}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_path($page, $page->baseUrl) }}#features">{{$page->t("Features")}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_path($page, $page->baseUrl) }}#about">{{ $page->t("About") }}</a>
                </li>
                {{-- <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_path($page, $page->baseUrl) }}#pricing">Pricing</a>
                </li> --}}
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_path($page, $page->baseUrl) }}#target_audience">{{ $page->t("Target audience") }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_path($page, $page->baseUrl) }}#contact">{{ $page->t("Contact") }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_path($page, $page->baseUrl) }}posts">{{ $page->t("Posts") }}</a>
                </li>
                <li class="nav-item nav-item-has-children">
                  <a href="javascript:void(0)">{{ $page->t('Language') }}</a>
                  <ul class="ud-submenu">
                  @foreach($page->locales as $localeCode => $localeName)
                    <li class="ud-submenu-item">
                      <a class="ud-submenu-link" href="{{ translate_url($page, $localeCode) }}">{{ $localeName }}</a>
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