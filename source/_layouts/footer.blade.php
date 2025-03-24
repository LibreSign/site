<footer class="ud-footer wow fadeInUp mt-5" data-aos-delay=".15s">
    <div class="shape shape-1">
        <img src="{{ $page->baseUrl }}assets/images/footer/shape-1.svg" alt="shape" />
    </div>

    <div class="shape shape-2">
        <img src="{{ $page->baseUrl }}assets/images/footer/shape-2.svg" alt="shape" />
    </div>

    <div class="shape shape-3">
        <img src="{{ $page->baseUrl }}assets/images/footer/shape-3.svg" alt="shape" />
    </div>

    <div class="ud-footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="ud-widget">
                        <a href="{{ locale_url($page, 'contact-us') }}#home" class="ud-footer-logo">
                            <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="logo" />
                        </a>
                        <p class="ud-widget-desc">
                            {{ $page->t("We create digital experiences for brands and companies by using technology.")}}
                        </p>
                        <ul class="ud-widget-socials">
                            <li>
                                <a target="_blank" href="https://github.com/LibreSign/libresign" title="{{ $page->t("LibreSign GitHub repository")}}">
                                    <i class="lni lni-github-original"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.linkedin.com/company/libresign/" title="{{ $page->t("LibreSign LinkedIn page")}}">
                                    <i class="lni lni-linkedin-original"></i>
                                </a>
                            </li>
                            <li>
                              <a target="_blank" href="https://t.me/LibreSign" title="{{ $page->t("LibreSign Telegram group")}}">
                                  <i class="lni lni-telegram-original"></i>
                              </a>
                          </li>
                          <li>
                            <a target="_blank" href="https://www.instagram.com/libresign/" title="{{ $page->t("LibreSign Instagram profile")}}">
                                <i class="lni lni-instagram-original"></i>
                            </a>
                        </li>
                        </ul>
                    </div>
                    <div class="ud-widget col-lg-5">
                        <a target="_blank" href="https://www.somos.coop.br/" title="{{ $page->t("Page to national movement that valozie cooperative initiatives.")}}">
                            <img src="{{ $page->baseUrl }}assets/images/icon/somoscoop.png" alt="icon_somos_coop">
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">{{ $page->t("About Us")}}</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ $page->baseUrl }}">{{ $page->t("Home")}}</a>
                            </li>
                            <li>
                                <a href="{{ $page->baseUrl }}#features">{{ $page->t("Features")}}</a>
                            </li>
                            <li>
                                <a href="{{ $page->baseUrl }}#about">{{ $page->t("About")}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">{{ $page->t("Features")}}</h5>
                        <ul class="ud-widget-links">
                            @foreach ($page->getFromCategory('features') as $item)
                              <li>
                                <a href="{{ $item['url'] }}">{{ $page->t($item['title']) }}</a>
                              </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ud-footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="ud-footer-bottom-left">
                        <li>
                            <a href="{{ locale_url($page, 'contact-us') }}privacy-policy">{{ $page->t("Privacy policy")}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p class="ud-footer-bottom-right">
                        {{ $page->t("Developed by")}} <a href="https://librecode.coop" rel="nofollow">LibreCode</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Back To Top Start ====== -->
    <a id="back-to-top" class="back-to-top">
        <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->
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

    <!-- ====== All Javascript Files ====== -->
    <script>
      window.baseUrl = "{{ $page->baseUrl === '/' ? '' : $page->baseUrl }}";
    </script>
    <script defer src="{{ rtrim($page->baseUrl, '/') . mix('js/main.js', 'assets/build') }}"></script>
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
</footer>
