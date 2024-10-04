@extends('_layouts.main')

@section('body')

 <!-- ====== Princiapl Banner Start ====== -->
    <section class="ud-hero" id="home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-hero-content wow fadeInUp" data-aos-delay=".2s">
              <h1 class="ud-hero-title">
                {{ $page->t( "Simplify your digital signatures and document management safely and efficiently") }}
              </h1>
              <p class="ud-hero-desc">
                {{ $page->t("Easily create, send, sign and track all your contracts in one place") }}
              </p>
              <ul class="ud-hero-buttons">
                <li>
                  <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-white-btn mt-1">
                    {{ $page->t('Talk to sales') }}
                  </a>
                </li>
              </ul>
            </div>
            <div class="ud-hero-image wow fadeInUp" data-aos-delay=".25s">
              <img src="{{ $page->baseUrl }}assets/images/print_main_screen.png" alt="print_main_screen"/>
              <img
                src="{{ $page->baseUrl }}assets/images/dotted-shape.svg"
                alt="shape"
                class="shape shape-1"
              />
              <img
                src="{{ $page->baseUrl }}assets/images/dotted-shape.svg"
                alt="shape"
                class="shape shape-2"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Princiapl Banner End ====== -->

    <!-- ====== Features Start ====== -->
    <section id="features" class="ud-features">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title">
              <span>{{ $page->t("Features")}}</span>
              <h2>{{ $page->t("Main features")}}</h2>
              <p>
                {{ $page->t("Beyond offering agility and security in digital signatures and document management, LibreSign features functionalities that adapt to the specific needs of your organization.") }}
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($page->getFromCategory('features') as $item)
            <div class="col-xl-3 col-lg-3 col-sm-6">
              <div class="ud-single-feature wow fadeInUp" data-aos-delay=".1s">
                <div class="ud-feature-icon">
                  <i class="lni lni-{{ $item['icon'] }}"></i>
                </div>
                <div class="ud-feature-content">
                  <div class="size-box-feature">
                    <h3>
                      <a class="ud-feature-title ud-feature-link fs-5 fw-bold" href="{{ $item['url'] }}">{{ $page->t($item['title']) }}</a>
                    </h3>
                    <p class="ud-feature-desc">{{ $page->t($item['description']) }}</p>
                  </div>
                  <div>
                    <a class="ud-main-btn" href="{{ $item['url'] }}">{{ $page->t("Learn more")}}</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- ====== Features End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
      <div class="container">
        <div class="ud-about-wrapper wow fadeInUp" data-aos-delay=".2s">
          <div class="ud-about-content-wrapper">
            <div class="ud-about-content">
              <span class="tag">{{ $page->t("About Us")}}</span>
              <h2>{{ $page->t("The perfect tool to manage the signature flow of your documents")}}</h2>
              <p>
                {{ $page->t("LibreSign is a web application for electronic signatures (e-Sign) developed by the LibreCode cooperative (Brazilian cooperative specialized in free software development). Its development began at the beginning of 2020, in the midst of the pandemic, when people and companies were migrating their physical documentation to digital, and then there was a need to develop a web solution that could offer the possibility of signing documents, contracts and proposals online with security and agility.")}}
              </p>

              <p>
                {{ $page->t("We use PKI technology to generate digital certificate keys. LibreSign is open source (and always will be), which allows it to be audited and customized for various needs and integrated with any system and, of course, maintained by the community.") }}
              </p>
              {{-- <a href="javascript:void(0)" class="ud-main-btn">Learn More</a> --}}
            </div>
          </div>
          <div class="ud-about-image">
            <img src="{{ $page->baseUrl }}assets/images/about/about-image.svg" alt="about-image" />
          </div>
        </div>
      </div>
    </section>
    <!-- ====== About End ====== -->

    @include('_partials/testimonial_card')    

    <!-- ====== Target Audience Start ====== -->
    <section id="target_audience" class="ud-about">
      <div class="container bg-white p-5 cards-one-below-the-other">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="card-title fs-4 fw-bold">{{ $page->t("Target audience")}}</h3>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-4 text-card">
            <div class="cards-target-audience">
              <h5 class="mb-3 text-white fs-5 fw-bold">{{ $page->t("Public sector")}}</h5>
              <hr class="mb-3 border border-2 opacity-50 rounded-pill">
              <p class="text-white">
                {{ $page->t("Optimize document management in the public sector with LibreSign. Our solution provides effective administration to handle specific government documentation, ensuring security, speed, and strict compliance with the General Data Protection Law (GDPR). Simplify bureaucratic processes, expedite document signing, and promote more efficient management with LibreSign for the public sector.") }}
              </p>
            </div>
          </div>
          <div class="col-4 text-card">
            <div class="cards-target-audience">
              <h5 class="mb-3 text-white fs-5 fw-bold">{{ $page->t("Education")}}</h5>
              <hr class="mb-3 border border-2 opacity-50 rounded-pill">
              <p class="text-white">
                {{$page->t("LibreSign is the ideal choice for educational institutions looking to enhance their document processes with legal validity. Simplify the signing of contracts, authorizations, and other essential documents for academic administration. Promote effective document management, providing a streamlined and modern experience for students, teachers, and administrative staff.")}}
              </p>
            </div>
          </div>
          <div class="col-4 text-card">
            <div class="cards-target-audience">
              <h5 class="mb-3 text-white fs-5 fw-bold">{{ $page->t("Private companies")}}</h5>
              <hr class="mb-3 border border-2 opacity-50 rounded-pill">
              <p class="text-white">
                {{ $page->t("Our electronic signature and document management solution streamline workflows, reducing time spent on manual processes. Achieve greater productivity, promote document security, and ensure compliance with the General Data Protection Law (GDPR), providing an agile experience for your clients and collaborators.") }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ====== Start Importance of digital signature ====== -->
    <section id="features" class="ud-features">
      <div class="container">
        <h3 class="mb-5">{{ $page->t('Did you know that digital signature is the safest and most efficient way to validate electronic documents?') }}</h3>

        <div class="row justify-content-md-center">
          <div class="col-lg-6 mb-4">
              <p>{{ $page->t("By using digital certificates issued by a Certification Authority, it is possible to ensure the signer's identity and the document's integrity. Physical signatures can be forged, compromising the validity of your documents. However, digital signatures, regulated by Provisional Measure No. 2.200-2/2001, provide the necessary security to protect the authenticity and legal validity of your documents.") }}</p>

              <h4 class="mb-3 mt-4">{{ $page->t('Transform your processes with more security and efficiency') }}</h4>
              <div class="row justify-content-md-center">
                <div class="col-lg-6 mb-2 d-flex justify-content-center">
                  <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="me-2 card-title"><i class="lni lni-protection"></i> {{ $page->t('Security') }}</h5>
                      <p class="card-text">{{ $page->t('Encrypted signatures that guarantee the integrity of your documents.') }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-2 d-flex justify-content-center">
                  <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title"><i class="lni lni-dashboard"></i> {{ $page->t('Speed') }}</h5>
                      <p class="card-text">{{ $page->t('Sign and send documents in seconds, from anywhere in the world.') }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center">
                  <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title"><i class="lni lni-sprout"></i> {{ $page->t('Sustainability') }}</h5>
                      <p class="card-text">{{ $page->t('Contribute to a greener world by eliminating the use of paper.') }}</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-lg-4">
            <img src="{{ $page->baseUrl }}assets/images/mobile_libresign.png" alt="print_main_screen"/>
          </div>
          <div class="col-lg-12 d-flex justify-content-center mt-5">
            <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-border-btn">
              {{ $page->t('Talk to sales') }}
            </a>
          </div>
        </div>
      </div>

    </section>
    <!-- ====== End Importance of digital signature ====== -->

    @include('_partials/contact_form')
@endsection
