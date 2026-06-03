<a href="#main-content" class="skip-to-content">{{ $page->t("Skip to main content") }}</a>
<header class="ud-header">
  <div class="container">
    <nav class="navbar navbar-expand-lg" role="navigation" aria-label="{{ $page->t('Main navigation') }}">
      <a class="navbar-brand" href="{{ locale_url($page, '')  }}" aria-label="{{ $page->t('LibreSign home') }}">
        <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign" />
      </a>
      <div class="collapse navbar-collapse mx-auto" id="main-navigation">
        <ul class="navbar-nav container">
          <li class="nav-item">
              <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'solutions') }}">{{$page->t("Solutions")}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'features') }}">{{$page->t("Features")}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'pricing') }}">{{ $page->t('Plans and Pricing')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'about') }}">{{ $page->t("About") }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'posts') }}">{{ $page->t("Content") }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'contact-us') }}">{{ $page->t("Contact") }}</a>
          </li>
          <li class="nav-item" id="customer-area-link">
            <a class="nav-link ud-menu-scroll link-button" href="{{ locale_url($page, 'client-area') }}" aria-label="{{ $page->t("Client Area") }}">
              <span class="button-text">{{ $page->t("Client Area") }}</span>
              <i class="lni lni-user button-icon" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="d-flex align-items-center">
        <div class="dropdown selector">
          <button class="dropdown-toggle"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  aria-label="{{ $page->t('Select language') }}">
            <img src="{{ $page->baseUrl }}assets/images/icon/languages/{{ current_path_locale($page) ?: 'en' }}.svg" alt="" role="presentation" />
            <span class="visually-hidden">{{ $page->t('Current language') }}: {{ $page->locales()[current_path_locale($page)] ?? 'English' }}</span>
          </button>
          <ul class="dropdown-menu ud-submenu" id="language-menu" aria-label="{{ $page->t('Language selection') }}">
          @foreach($page->locales() as $localeCode => $localeName)
            <li class="ud-submenu-item">
              <a class="ud-submenu-link"
                 href="{{ translate_url($page, $localeCode) }}"
                 lang="{{ $localeCode ?: 'en' }}"
                 aria-label="{{ $page->t('Switch to') }} {{ $localeName }}">
                <img src="{{ $page->baseUrl }}assets/images/icon/languages/{{ $localeCode ?: 'en' }}.svg" alt="" role="presentation" />
                <span>{{ $localeCode ?: 'en'}}</span>
              </a>
            </li>
          @endforeach
          </ul>
        </div>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#main-navigation"
                aria-label="{{$page->t("Toggle navigation menu")}}"
                aria-expanded="false"
                aria-controls="main-navigation">
          <span class="toggler-icon" aria-hidden="true"> </span>
          <span class="toggler-icon" aria-hidden="true"> </span>
          <span class="toggler-icon" aria-hidden="true"> </span>
        </button>
      </div>
    </nav>
  </div>
</header>
