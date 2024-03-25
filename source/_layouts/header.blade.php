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
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#features">Features</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#about">About</a>
                </li>
                {{-- <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#pricing">Pricing</a>
                </li> --}}
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#target_audience">Target Audience</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#contact">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="ud-menu-scroll" href="{{ $page->baseUrl }}posts">Posts</a>
                </li>
                <li>
                  @foreach(['en','pt-br'] as $locale)
                    <a href="{{ translate_url($page, $locale) }}"> {{ $locale }} </a>
                  @endforeach
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
</header>