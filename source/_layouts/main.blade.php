<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $page->title }}</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="LibreSign - Electronic signature of digital documents">
    <link rel="canonical" href="{{ $page->getUrl() }}">
    <meta name="description" content="{{ $page->description }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://uideck.com/play/">
    <meta property="og:title" content="LibreSign - Electronic signature of digital documents">
    <meta property="og:description" content="LibreSign - Electronic signature of digital documents">
    <!-- TODO: Think about the image -->
    <meta property="og:image" content="">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://uideck.com/play/">
    <meta property="twitter:title" content="LibreSign - Electronic signature of digital documents">
    <meta property="twitter:description" content="LibreSign - Electronic signature of digital documents">
    <!-- TODO: Think about the image -->
    <meta property="twitter:image" content="">

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="{{ $page->baseUrl }}assets/images/favicon.svg"
      type="image/svg"
    />

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{ $page->baseUrl }}assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ $page->baseUrl }}assets/css/animate.css" />
    <link rel="stylesheet" href="{{ $page->baseUrl }}assets/css/lineicons.css" />
    <link rel="stylesheet" href="{{ $page->baseUrl }}assets/css/ud-styles.css" />
    <link rel="stylesheet" href="{{ $page->baseUrl }}{{ mix('css/main.css', 'assets/build') }}">
    <!-- Primary Meta Tags -->
    <script defer src="{{ $page->baseUrl }}{{ mix('js/main.js', 'assets/build') }}"></script>
  </head>
  <body>
    <!-- ====== Header Start ====== -->
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
                    <a class="ud-menu-scroll" href="{{ $page->baseUrl }}">Home</a>
                  </li>

                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#pricing">Pricing</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="{{ $page->baseUrl }}#contact">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="./html_pages/blog.html">Blog</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ====== Header End ====== -->
      @yield('body')
      @if($page->production)
        <script>
          var _mtm = window._mtm = window._mtm || [];
          _mtm.push({'mtm.startTime': (new Date().getTime()), 
          'event': 'mtm.Start'});
          (function() {
            var d=document, g=d.createElement('script'), 
            s=d.getElementsByTagName('script')[0];
            g.async=true; 
            g.src='https://matomo.librecode.coop/js/container_8jNjdh8C.js'; 
            s.parentNode.insertBefore(g,s);
          })();
        </script>
      @else
        <script>
          var _mtm = window._mtm = window._mtm || [];
          _mtm.push({'mtm.startTime': (new Date().getTime()), 
          'event': 'mtm.Start'});
          (function() {
            var d=document, g=d.createElement('script'), 
            s=d.getElementsByTagName('script')[0];
            g.async=true; 
            g.src='https://matomo.librecode.coop/js/container_8jNjdh8C_dev_dc9cf71ee2745d3690156798.js'; 
            s.parentNode.insertBefore(g,s);
          })();
        </script>
      @endif
      <!-- ====== Footer Start ====== -->
    @include('_layouts.footer')
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a id="back-to-top" class="back-to-top">
      <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    <script src="{{ $page->baseUrl }}assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ $page->baseUrl }}assets/js/wow.min.js"></script>
    <script src="{{ $page->baseUrl }}assets/js/main.js"></script>
    <script>
        document.getElementById('back-to-top').onclick = function(e) {
            e.preventDefault()
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            })
        };

      // ==== for menu scroll
      const pageLink = document.querySelectorAll(".ud-menu-scroll");

      pageLink.forEach((elem) => {
        elem.addEventListener("click", (e) => {
          e.preventDefault();
          document.querySelector(elem.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
            offsetTop: 1 - 60,
          });
        });
      });

      // section menu active
      function onScroll(event) {
        const sections = document.querySelectorAll(".ud-menu-scroll");
        const scrollPos =
          window.pageYOffset ||
          document.documentElement.scrollTop ||
          document.body.scrollTop;

        for (let i = 0; i < sections.length; i++) {
          const currLink = sections[i];
          const val = currLink.getAttribute("href");
          const refElement = document.querySelector(val);
          const scrollTopMinus = scrollPos + 73;
          if (
            refElement.offsetTop <= scrollTopMinus &&
            refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
          ) {
            document
              .querySelector(".ud-menu-scroll")
              .classList.remove("active");
            currLink.classList.add("active");
          } else {
            currLink.classList.remove("active");
          }
        }
      }

      window.document.addEventListener("scroll", onScroll);
    </script>
  </body>
</html>
