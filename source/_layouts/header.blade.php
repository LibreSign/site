<header class="ud-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ locale_url($page, '')  }}">
              <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign" />
            </a>
            <div class="navbar-collapse">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item nav-item-has-children">
                    <a class="ud-menu-scroll" href="{{ locale_url($page, 'solutions') }}">{{$page->t("Solutions")}}</a>
                </li>
                <li class="nav-item nav-item-has-children">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'features') }}">{{$page->t("Features")}}</a>
                </li>
                <li class="nav-item nav-item-has-children"><a class="ud-menu-scroll" href="{{ locale_url($page, 'pricing') }}">{{ $page->t('Plans and Pricing')}}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'about') }}">{{ $page->t("About") }}</a>
                </li>
                <li class="nav-item nav-item-has-children">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'posts') }}">{{ $page->t("Content") }}</a>
                </li>
                <li class="nav-item nav-item-has-children">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'contact') }}">{{ $page->t("Contact") }}</a>
                </li>
                <li class="nav-item" id="customer-area-link">
                  <a class="ud-menu-scroll link-button" href="{{ locale_url($page, 'client-area') }}">{{ $page->t("Client Area") }}</a>
                </li>
              </ul>
            </div>
            <div class="selector">
              <button type="button"><img src="{{ $page->baseUrl }}assets/images/icon/languages/{{ current_path_locale($page) ?: 'en' }}.svg" alt="{{ $page->t('Language') }}" /></button>
              <ul class="ud-submenu">
              @foreach($page->locales as $localeCode => $localeName)
                <li class="ud-submenu-item">
                  <a class="ud-submenu-link" href="{{ translate_url($page, $localeCode) }}">
                    <img src="{{ $page->baseUrl }}assets/images/icon/languages/{{ $localeCode ?: 'en' }}.svg" alt="{{ $localeName }}" />
                    <span>{{ $localeCode ?: 'en'}}</span>
                  </a>
                </li>
              @endforeach
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
</header>
