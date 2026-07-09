<!DOCTYPE html>
<html lang="{{ current_path_locale($page) ?: 'en' }}">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>

    <!-- Primary Meta Tags -->
    <link rel="canonical" href="{{ $page->getUrl() }}">
    <meta name="description" content="{{ $page->description }}">
    @if($page->noindex)<meta name="robots" content="noindex, nofollow">@endif
    <meta name="keywords" content="LibreSign, electronic signature, digital signature, open source, self-hosted, Nextcloud, document signing, e-sign, privacy, data sovereignty">
    <meta name="author" content="LibreSign / LibreCode">

    <!-- Hreflang: multilingual support -->
    @foreach($page->locales() as $localeCode => $localeName)
    <link rel="alternate" hreflang="{{ $localeCode ?: 'en' }}" href="{{ translate_url($page, $localeCode) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ translate_url($page, '') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $page->getUrl() }}">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:image" content="{{ rtrim($page->baseUrl, '/') }}/assets/images/logo/logo-libresign-large.png">
    <meta property="og:site_name" content="LibreSign">
    <meta property="og:locale" content="{{ str_replace('-', '_', current_path_locale($page) ?: 'en') }}">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $page->getUrl() }}">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $page->description }}">
    <meta name="twitter:image" content="{{ rtrim($page->baseUrl, '/') }}/assets/images/logo/logo-libresign-large.png">
    <meta name="twitter:site" content="@libresign">

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="{{ $page->baseUrl }}assets/images/favicon.png"
      type="image/png"
    >
    <link rel="apple-touch-icon" href="{{ $page->baseUrl }}assets/images/favicon.png">

    <!-- ===== All CSS files ===== -->
    @viteRefresh()
    <link rel="stylesheet" href="{{ rtrim($page->baseUrl, '/') . vite('source/_assets/scss/ud-styles.scss') }}">
    @stack('styles')

    <!-- ====== All Javascript Files ====== -->
    <script>
        var _mtm = window._mtm = window._mtm || [];
        _mtm.push({'mtm.startTime': (new Date().getTime()),
        'event': 'mtm.Start'});
        (function() {
            var d=document, g=d.createElement('script'),
            s=d.getElementsByTagName('script')[0];
            g.async=true;
            g.src='https://matomo.librecode.coop/js/container_{{ $page->matomo_container }}.js';
            s.parentNode.insertBefore(g,s);
        })();
    </script>

    <script>
      window.baseUrl = "{{ $page->baseUrl === '/' ? '' : $page->baseUrl }}";
    </script>

    <script type="module" src="{{ rtrim($page->baseUrl, '/') . vite('source/_assets/js/main.js') }}"></script>
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var backToTop = document.getElementById('back-to-top');
            if (backToTop) {
                backToTop.onclick = function(e) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
                };
            }

            // ==== for menu scroll
            const pageLink = document.querySelectorAll(".ud-menu-scroll");

        pageLink.forEach((elem) => {
            elem.addEventListener("click", (e) => {
                var url = elem.getAttribute("href")
                var anchor = url.match(/(#.*)$/)
                if (window.location.pathname !== '/' || anchor === null) {
                    return
                }
                anchor = anchor[1]
                e.preventDefault();
                document.querySelector(anchor).scrollIntoView({
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
                const url = currLink.getAttribute("href");
                var anchor = url.match(/(#.*)$/)
                if (anchor === null) {
                    continue
                }
                anchor = anchor[1]
                const refElement = document.querySelector(anchor);
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
        }); // end DOMContentLoaded
    </script>

    <!-- Structured data: base Organization + WebSite -->
    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Organization",
          "@id": "https://libresign.coop/#organization",
          "name": "LibreSign",
          "url": "https://libresign.coop",
          "logo": {
            "@type": "ImageObject",
            "url": "https://libresign.coop/assets/images/logo/logo.svg"
          },
          "sameAs": [
            "https://github.com/LibreSign/libresign",
            "https://www.linkedin.com/company/libresign/",
            "https://t.me/LibreSign",
            "https://www.instagram.com/libresign/"
          ]
        },
        {
          "@type": "WebSite",
          "@id": "https://libresign.coop/#website",
          "url": "https://libresign.coop",
          "name": "LibreSign",
          "description": "Open source electronic signature and digital document management, integrated with Nextcloud.",
          "publisher": {
            "@id": "https://libresign.coop/#organization"
          }
        }
      ]
    }
    </script>
    @endverbatim
    @stack('structured-data')
  </head>
  <body id="top">
    @include('_layouts.header')
    <main id="main-content">
      @yield('body')
    </main>
    @include('_layouts.footer')
  </body>
</html>
