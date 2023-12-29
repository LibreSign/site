<footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
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
                        <a href="index.html" class="ud-footer-logo">
                            <img src="{{ $page->baseUrl }}assets/images/logo/logo.png" alt="logo" />
                        </a>
                        <p class="ud-widget-desc">
                            We create digital experiences for brands and companies by
                            using technology.
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
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">About Us</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="javascript:void(0)">Home</a>
                            </li>
                            <li>
                                <a href="#features">Features</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">Features</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="javascript:void(0)">Free and Open-Source</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Multiple signers</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Hybrid signatures</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Qrcode validation</a>
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
                            <a href="javascript:void(0)">Privacy policy</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Support policy</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Terms of service</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p class="ud-footer-bottom-right">
                        Developed by <a href="https://librecode.coop" rel="nofollow">LibreCode</a>
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
</footer>
