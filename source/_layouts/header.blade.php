<header class="ud-header">
  <div class="container">
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="{{ locale_url($page, '')  }}">
        <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign" />
      </a>
      <div class="navbar-collapse mx-auto">
        <ul class="navbar-nav container">
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
            <a class="ud-menu-scroll link-button" href="{{ locale_url($page, 'client-area') }}" aria-label="{{ $page->t("Client Area") }}">
              <span class="button-text">{{ $page->t("Client Area") }}</span>
              <i class="lni lni-user button-icon" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="d-flex align-items-center">
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
        <button class="navbar-toggler" title="{{$page->t("Toggle navigation menu")}}">
          <span class="toggler-icon"> </span>
          <span class="toggler-icon"> </span>
          <span class="toggler-icon"> </span>
        </button>
      </div>
    </nav>
  </div>
</header>
