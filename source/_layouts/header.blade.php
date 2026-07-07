@php
    $isHeaderFragment = (bool) $page->get('isHeaderFragment');
    $siteOrigin = rtrim($page->get('siteOrigin') ?: $page->baseUrl, '/');
    $headerAssetBase = $isHeaderFragment ? $siteOrigin . '/' : $page->baseUrl;
    $headerCssUrl = $isHeaderFragment ? $siteOrigin . vite('source/_assets/scss/header-fragment.scss') : '';
    $headerJsUrl = $isHeaderFragment ? $siteOrigin . vite('source/_assets/js/header-fragment.js') : '';
    $headerLocaleUrl = function (string $path = '') use ($page, $isHeaderFragment, $siteOrigin) {
        $url = locale_url($page, $path);

        if (! $isHeaderFragment) {
            return $url;
        }

        return $siteOrigin . '/' . ltrim($url, '/');
    };
    $headerTranslateUrl = function (string $localeCode = '') use ($page, $isHeaderFragment, $siteOrigin) {
        $url = translate_url($page, $localeCode);

        if (! $isHeaderFragment) {
            return $url;
        }

        return $siteOrigin . '/' . ltrim($url, '/');
    };
@endphp

<div class="libresign-site-header-fragment"
     @if($headerCssUrl) data-fragment-css="{{ $headerCssUrl }}" @endif
     @if($headerJsUrl) data-fragment-js="{{ $headerJsUrl }}" @endif>
  <a href="#main-content" class="skip-to-content">{{ $page->t("Skip to main content") }}</a>
  <header class="ud-header" data-libresign-header>
    <div class="container">
      <nav class="navbar navbar-expand-xl" aria-label="{{ $page->t('Main navigation') }}">
      <a class="navbar-brand" href="{{ $headerLocaleUrl('')  }}" aria-label="{{ $page->t('LibreSign home') }}">
        <img src="{{ $headerAssetBase }}assets/images/logo/logo.svg" alt="LibreSign">
      </a>
      <div class="collapse navbar-collapse mx-auto" id="main-navigation">
        <ul class="navbar-nav container">
          <li class="nav-item dropdown ud-nav-dropdown">
            <a class="nav-link ud-nav-dropdown-toggle dropdown-toggle"
               href="#"
               role="button"
               id="solutions-menu-toggle"
               data-libresign-dropdown-toggle
               aria-controls="solutions-menu"
               aria-expanded="false"
               aria-label="{{ $page->t('Open solutions submenu') }}">
              {{ $page->t("Solutions") }}
            </a>
            <ul class="dropdown-menu ud-nav-submenu"
                id="solutions-menu"
                hidden
                aria-labelledby="solutions-menu-toggle"
                aria-label="{{ $page->t('Solutions submenu') }}">
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ $headerLocaleUrl('lawyers') }}">
                  {{ $page->t('Lawyers') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ $headerLocaleUrl('tecnical-details') }}">
                  {{ $page->t('IT Professionals') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ $headerLocaleUrl('company-solutions') }}">
                  {{ $page->t('Companies') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ $headerLocaleUrl('cooperatives') }}">
                  {{ $page->t('Cooperatives') }}
                </a>
              </li>
              <li>
                <a class="dropdown-item ud-nav-submenu-link" href="{{ $headerLocaleUrl('public-sector') }}">
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
               data-libresign-dropdown-toggle
               aria-controls="features-menu"
               aria-expanded="false"
               aria-label="{{ $page->t('Open features submenu') }}">
              {{$page->t("Features")}}
            </a>
            <ul class="dropdown-menu ud-nav-submenu"
                id="features-menu"
                hidden
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
                <a class="dropdown-item ud-nav-submenu-link ud-nav-submenu-link--all" href="{{ $headerLocaleUrl('features') }}">
                  {{ $page->t('All Features →') }}
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ $headerLocaleUrl('pricing') }}">{{ $page->t('Plans and Pricing')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ $headerLocaleUrl('about') }}">{{ $page->t("About") }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ $headerLocaleUrl('posts') }}">{{ $page->t("Blog") }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ud-menu-scroll" href="{{ $headerLocaleUrl('contact-us') }}">{{ $page->t("Contact") }}</a>
          </li>
          <li class="nav-item" id="customer-area-link">
            <a class="nav-link ud-menu-scroll link-button" href="https://account.libresign.coop/" target="_blank" rel="noopener noreferrer">
              {{ $page->t("Client Area") }}
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
                  data-libresign-dropdown-toggle
                  aria-controls="language-menu"
                  aria-expanded="false"
                  aria-label="{{ $page->t('Select language') }}">
            <img src="{{ $headerAssetBase }}assets/images/icon/languages/{{ $activeLocale }}.svg" alt="" aria-hidden="true">
            <span class="visually-hidden">{{ $page->t('Current language') }}: {{ $page->locales()[$activeLocale] ?? 'English' }}</span>
          </button>
          <ul class="dropdown-menu ud-submenu" id="language-menu" hidden aria-label="{{ $page->t('Language selection') }}">
          @foreach($page->locales() as $localeCode => $localeName)
            <li class="ud-submenu-item">
              <a class="ud-nav-submenu-link ud-submenu-link"
                 href="{{ $headerTranslateUrl($localeCode) }}"
                 lang="{{ $localeCode ?: 'en' }}"
                 aria-label="{{ $page->t('Switch to') }} {{ $localeName }}">
                <img src="{{ $headerAssetBase }}assets/images/icon/languages/{{ $localeCode ?: 'en' }}.svg" alt="" aria-hidden="true">
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
        <button class="navbar-toggler collapsed"
          data-libresign-header-toggle
                type="button"
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
  @if($isHeaderFragment)
    <div class="libresign-site-header-fragment__spacer" aria-hidden="true"></div>
  @endif
</div>
