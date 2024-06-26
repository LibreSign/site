@extends('_layouts.main')

@section('body')

  <section class="ud-hero" id="home">
    <div class="container text-center">
      <div class="row pb-5 justify-content-md-center">
        <div class="col-lg-6 mb-3">
          <h3 class="text-light">
            {{ $page->t( 'Simplify your digital signatures and document management safely and efficiently') }}
          </h3>

          <p class="text-light mt-3 pe-5 ps-5">{{ $page->t('Easily create, send, sign and track all your contracts in one place') }}</p>

          <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="btn btn-light mt-4 p-3">{{ $page->t('Talk to sales') }}</a>

        </div>
        <div class="col-lg-6">
          <img class="mt-3" src="{{ $page->baseUrl }}assets/images/print_main_screen.png" alt="print_main_screen" />
        </div>
      </div>

    </div>
  </section>

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
                  <h3>
                    <a class="ud-feature-title ud-feature-link fs-5 fw-bold" href="{{ $item['url'] }}">{{ $page->t($item['title']) }}</a>
                  </h3>
                  <p class="ud-feature-desc">{{ $page->t($item['description']) }}</p>
                  <a class="ud-main-btn" href="{{ $item['url'] }}">{{ $page->t("Learn more")}}</a>
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
              <p>{{ $page->t('It uses digital certificates issued by a Certificate Authority to guarantee the identity of the signer and the integrity of the document.Simple physical or electronic signatures can be forged, putting the validity of your documents at risk. Digital signatures, regulated by Provisional Measure No. 2,200-2/2001, guarantee the necessary security.') }}</p>

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

    <!-- ====== FAQ Start ====== -->
    <section id="faq" class="ud-faq">
      <div class="shape">
        <img src="{{ $page->baseUrl }}assets/images/faq/shape.svg" alt="shape" />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <span>FAQ</span>
              <h2>{{ $page->t("Any Questions? Answered")}}</h2>
              <p>
                {{ $page->t("LibreSign frequently asked questions")}}
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-aos-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>{{ $page->t("Why LibreSign?")}}</span>
                </button>
                <div id="collapseOne" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ $page->t("LibreSign allows documents to be signed securely and with legal validity, since the system generates hashing - an algorithm that ensures that the file has not been altered after being signed - as well as numbers and records the times of each signature carried out in the document. In this way, the system meets all the requirements of the GDPR - General Data Protection Law.")}}
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-aos-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>{{ $page->t("What is electronic signature capture?")}}</span>
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ $page->t("Electronic signature capture is a technology for signing electronic document files with a handwritten signature. The use of this technology allows for the elimination of the mailing, storage, filing, copying, and retrieval of paper documents. This will save your business time and money.")}}
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-aos-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>
                    {{ $page->t("What are the key features of LibreCode signature pads?")}}
                  </span>
                </button>
                <div id="collapseThree" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ $page->t("File Creation, Signature with Digital Certificate, Signature Management, Document Management, Validation, API")}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-aos-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFour"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>
                    {{ $page->t("Is a digital signature the same as a digitized signature?")}}
                  </span>
                </button>
                <div id="collapseFour" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ $page->t("No. The digitized signature is the reproduction of the handwritten signature as an image using scanner-type. It does not guarantee the authorship and of the electronic document, as there is no association between the signer and the text, as it can be easily copied and inserted another document.")}}
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-aos-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFive"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>
                    {{ $page->t("What is the name of the company that LibreSign was developed by?")}}
                  </span>
                </button>
                <div id="collapseFive" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ $page->t("LibreCode, a Brazilian cooperative of free software developers.")}}
                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="ud-single-faq wow fadeInUp" data-aos-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseSix"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Where and how to host this template?</span>
                </button>
                <div id="collapseSix" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </section>
    <!-- ====== FAQ End ====== -->
    @include('_partials/contact_form')
@endsection
