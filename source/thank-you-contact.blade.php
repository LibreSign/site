@extends('_layouts.main')

@section('body')
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

    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="ud-banner-content">
                
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Banner End ====== -->
  
      <!-- ====== Error 404 Start ====== -->
      <section class="ud-404">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="ud-404-wrapper">
                <div class="ud-404-content">
                  <h2 class="ud-404-title">Thank you!</h2>
                  <h5 class="ud-404-subtitle">
                    Maybe you can find what you need here?
                  </h5>
                  <ul class="ud-404-links">
                    <li>
                      <a href="{{ $page->baseUrl }}">Home</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Error 404 End ====== -->

    <!-- ====== Footer Start ====== -->
    @extends('_layouts.footer')
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
