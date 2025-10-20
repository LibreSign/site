<header class="ud-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ locale_url($page, '')  }}">
              <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign" />
            </a>
            <div class="navbar-collapse">
              <ul id="nav" class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="ud-menu-scroll" href="{{ locale_url($page, 'solutions') }}">
                      {{$page->t("Solutions")}}
                      <i class="lni lni-chevron-down"></i>
                    </a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'features') }}">
                    {{$page->t("Features")}}
                    <i class="lni lni-chevron-down"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'pricing') }}">
                    {{ $page->t('Plans and Pricing')}}
                    <i class="lni lni-chevron-down"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'about') }}">{{ $page->t("About") }}</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'posts') }}">
                    {{ $page->t("Content") }}
                    <i class="lni lni-chevron-down"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ locale_url($page, 'contact') }}">
                    {{ $page->t("Contact") }}
                    <i class="lni lni-chevron-down"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll link-button" href="{{ locale_url($page, 'client-area') }}">{{ $page->t("Client Area") }}</a>
                </li>
                <li class="nav-item nav-item-has-children">
                  <button type="button">{{ $page->t('Language') }}</button>
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
