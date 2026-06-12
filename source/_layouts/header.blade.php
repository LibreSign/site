<a href="#main-content" class="skip-to-content">{{ $page->t("Skip to main content") }}</a>
<header class="ud-header">
  <div class="container">
      <nav class="navbar navbar-expand-lg" aria-label="{{ $page->t('Main navigation') }}">
      <a class="navbar-brand" href="{{ locale_url($page, '')  }}" aria-label="{{ $page->t('LibreSign home') }}">
        <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign">
      </a>
      <div class="collapse navbar-collapse mx-auto" id="main-navigation">
        <ul class="navbar-nav container">
          <li class="nav-item dropdown ud-nav-dropdown">
            <a class="nav-link ud-nav-dropdown-toggle dropdown-toggle"
               href="#"
               role="button"
               id="solutions-menu-toggle"
               data-bs-toggle="dropdown"
               aria-expanded="false"
               aria-label="{{ $page->t('Open solutions submenu') }}">
              {{ $page->t("Solutions") }}
            </a>
            <ul class="dropdown-menu ud-nav-submenu"
                aria-labelledby="solutions-menu-toggle"
                aria-label="{{ $page->t('Solutions submenu') }}">
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ locale_url($page, 'lawyers') }}">
                  {{ $page->t('Lawyers') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ locale_url($page, 'tecnical-details') }}">
                  {{ $page->t('IT Professionals') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ locale_url($page, 'company-solutions') }}">
                  {{ $page->t('Companies') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ locale_url($page, 'cooperatives') }}">
                  {{ $page->t('Cooperatives') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ locale_url($page, 'public-sector') }}">
                  {{ $page->t('Public Sector') }}
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown ud-nav-dropdown">
            <a class="nav-link ud-nav-dropdown-toggle dropdown-toggle"
               href="#"
               role="button"
               id="features-menu-toggle"
               data-bs-toggle="dropdown"
               aria-expanded="false"
               aria-label="{{ $page->t('Open features submenu') }}">
              {{$page->t("Features")}}
            </a>
            <ul class="dropdown-menu ud-nav-submenu"
                aria-labelledby="features-menu-toggle"
                aria-label="{{ $page->t('Features submenu') }}">
              @foreach($page->getFromCategory('featured') as $featuredPost)
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ $featuredPost->url }}">
                  {{ $page->t($featuredPost->title) }}
                </a>
              </li>
              @endforeach
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link ud-nav-submenu-link--all" href="{{ locale_url($page, 'features') }}">
                  {{ $page->t('All Features →') }}
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'pricing') }}">{{ $page->t('Plans and Pricing')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'about') }}">{{ $page->t("About") }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'posts') }}">{{ $page->t("Blog") }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ locale_url($page, 'contact-us') }}">{{ $page->t("Contact") }}</a>
          </li>
          <li class="nav-item" id="customer-area-link">
            <a class="nav-link ud-menu-scroll link-button" href="https://account.libresign.coop/" target="_blank" rel="noopener noreferrer" aria-label="{{ $page->t("Client Area") }}">
              <span class="button-text">{{ $page->t("Client Area") }}</span>
              <i class="lni lni-user button-icon" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="d-flex align-items-center">
        @php
          $detectedLocale = current_path_locale($page);
          $availableLocales = array_keys($page->locales());
          $activeLocale = in_array($detectedLocale, $availableLocales) ? $detectedLocale : 'en';
        @endphp
        <div class="dropdown selector">
          <button class="dropdown-toggle ud-nav-dropdown-toggle"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  aria-label="{{ $page->t('Select language') }}">
            <img src="{{ $page->baseUrl }}assets/images/icon/languages/{{ $activeLocale }}.svg" alt="" aria-hidden="true">
            <span class="visually-hidden">{{ $page->t('Current language') }}: {{ $page->locales()[$activeLocale] ?? 'English' }}</span>
          </button>
          <ul class="dropdown-menu ud-submenu" id="language-menu" aria-label="{{ $page->t('Language selection') }}">
          @foreach($page->locales() as $localeCode => $localeName)
            <li class="ud-submenu-item">
              <a class="ud-nav-submenu-link ud-submenu-link"
                 href="{{ translate_url($page, $localeCode) }}"
                 lang="{{ $localeCode ?: 'en' }}"
                 aria-label="{{ $page->t('Switch to') }} {{ $localeName }}">
                <img src="{{ $page->baseUrl }}assets/images/icon/languages/{{ $localeCode ?: 'en' }}.svg" alt="" aria-hidden="true">
                <span>{{ $localeCode ?: 'en'}}</span>
              </a>
            </li>
          @endforeach
            <li><hr></li>
            <li class="ud-submenu-item">
              <a class="ud-nav-submenu-link ud-submenu-link ud-submenu-link--cta"
                 href="https://hosted.weblate.org/projects/libresign-coop-site/site/"
                 target="_blank"
                 rel="noopener noreferrer"
                 aria-label="{{ $page->t('Help translate this site') }}">
                <span>{{ $page->t('Help translate ✏️') }}</span>
              </a>
            </li>
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
