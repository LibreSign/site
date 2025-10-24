<!DOCTYPE html>
<html lang="{{ current_path_locale($page) }}">
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
      href="{{ $page->baseUrl }}assets/images/favicon.png"
      type="image/png"
    />

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{ $page->baseUrl }}assets/compiled/css/ud-styles.css" />
    @stack('styles')

    <!-- ====== All Javascript Files ====== -->
    <script defer>
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

    <script defer>
      window.baseUrl = "{{ $page->baseUrl === '/' ? '' : $page->baseUrl }}";
    </script>

    <script defer src="{{ rtrim($page->baseUrl, '/') . mix('js/main.js', 'assets/compiled') }}"></script>

    <script defer>
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
    </script>
  </head>
  <body>
    @include('_layouts.header')
    <main id="main-content">
      @yield('body')
    </main>
    @include('_layouts.footer')
  </body>
</html>
