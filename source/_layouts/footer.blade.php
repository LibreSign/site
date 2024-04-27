<footer class="ud-footer wow fadeInUp mt-5" data-wow-delay=".15s">
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
                        <a href="{{ locale_path($page, $page->baseUrl) }}#home" class="ud-footer-logo">
                            <img src="{{ $page->baseUrl }}assets/images/logo/logo.png" alt="logo" />
                        </a>
                        <p class="ud-widget-desc">
                            {{ $page->t("We create digital experiences for brands and companies by using technology.",current_path_locale($page))}}
                        </p>
                        <ul class="ud-widget-socials">
                            <li>
                                <a href="https://github.com/LibreSign/libresign">
                                    <i class="lni lni-github-original"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/libresign/">
                                    <i class="lni lni-linkedin-original"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/LibreCodeCoop">
                                    <i class="lni lni-telegram-original"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="ud-widget col-lg-5">
                        <a href="https://www.somos.coop.br/">
                            <img src="{{ $page->baseUrl }}assets/images/icon/somoscoop.png" alt="icon_somos_coop">
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">{{ $page->t("About Us",current_path_locale($page))}}</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ $page->baseUrl }}">{{ $page->t("Home",current_path_locale($page))}}</a>
                            </li>
                            <li>
                                <a href="{{ $page->baseUrl }}#features">{{ $page->t("Features",current_path_locale($page))}}</a>
                            </li>
                            <li>
                                <a href="{{ $page->baseUrl }}#about">{{ $page->t("About",current_path_locale($page))}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">{{ $page->t("Features",current_path_locale($page))}}</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="javascript:void(0)">{{ $page->t("Free and Open-Source",current_path_locale($page))}}</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">{{ $page->t("Multiple signers",current_path_locale($page))}}</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">{{ $page->t("Hybrid signatures",current_path_locale($page))}}</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">{{ $page->t("Qrcode validation",current_path_locale($page))}}</a>
                            </li>
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
                            <a href="{{ locale_path($page, $page->baseUrl) }}privacy-policy">{{ $page->t("Privacy policy")}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p class="ud-footer-bottom-right">
                        {{ $page->t("Developed by",current_path_locale($page))}} <a href="https://librecode.coop" rel="nofollow">LibreCode</a>
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