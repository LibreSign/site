@extends('_layouts.main')

@section('body')

 <!-- ====== Princiapl Banner Start ====== -->
    <section class="ud-hero">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="ud-hero-content wow fadeInUp" data-aos-delay=".2s">
              <h1 class="ud-hero-title">
                {{ $page->t("The secure and legally binding digital signature for your world.") }}
              </h1>
              <p class="ud-hero-desc">
                {{ $page->t("Reduce bureaucracy and speed up your processes: sign, manage, and validate documents with technology you control.") }}
              </p>
              <div class="row justify-content-between ud-hero-buttons g-4">
                <div class="col-sm-6 justify-content-center d-flex">
                  <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn w-100 text-center">
                    {{ $page->t('Try it For Free Now!') }}
                  </a>
                </div>
                <div class="col-sm-6 justify-content-center d-flex">
                  <a href="{{ locale_url($page, 'contact-us') }}" class="ud-secondary-btn w-100 text-center">
                    {{ $page->t('Talk to Our Experts') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ud-hero-image text-center wow fadeInUp" data-aos-delay=".3s">
              <img src="{{ $page->baseUrl }}assets/images/hero/hero-image.png" alt="{{ $page->t('Professional using digital signature') }}" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Princiapl Banner End ====== -->

    <section class="clients">
      <div class="container">
        <div class="row">
          <div class="col-12 headline">
            <p>{{ $page->t("Validated Trust: LibreSign Solutions from Those Who Understand Governance and Efficiency.") }}</p>
          </div>
        </div>
        <div class="row logos g-5 justify-content-evenly">
          <div class="col-12 col-md-auto">
            <img width="264px" src="{{ $page->baseUrl }}assets/images/logo/clients/ocb.png" alt="Sistema OCB/RJ">
          </div>
          <div class="col-12 col-md-auto">
            <img width="256px" src="{{ $page->baseUrl }}assets/images/logo/clients/oab.png" alt="OAB|ESA">
          </div>
          <div class="col-12 col-md-auto">
            <img width="80px" src="{{ $page->baseUrl }}assets/images/logo/clients/fiocruz.png" alt="Fiocruz">
          </div>
        </div>
        <div class="row">
          <div class="secondary">
            <p>{{ $page->t("More than X million documents signed securely and with legal validity.") }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ====== Target Audience Start ====== -->
    <section class="ud-about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="card-title fs-1 fw-bold">{{ $page->t("Eliminate Bureaucracy, Ensure Security: LibreSign Solves Your Biggest Challenges.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="card-subtitle">{{ $page->t("We understand the complexities of each industry. See how our platform is the answer you're looking for.") }}</p>
          </div>
        </div>
        <div class="row text-center justify-content-evenly">
          <div class="col-xl-4 col-md-6 col-sm-12 col-12 text-card mb-4">
            <div class="main-cards">
              <div class="card-header-section">
                <h5>{{ $page->t("Legal Validity and Undisputed Compliance?")}}</h5>
              </div>
              <div class="card-icon-section">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/legal-validity.svg" alt="" />
              </div>
              <div class="card-description-section">
                <p>
                  {{ $page->t("Minimize risks and ensure the authenticity of each document with electronic signatures that fully comply with the LGPD and current legislation.") }}
                </p>
              </div>
              <div class="card-button-section">
                <ul class="ud-hero-buttons">
                  <li>
                    <a href="{{ locale_url($page, 'public-sector') }}" class="ud-main-btn">
                      {{ $page->t('Learn More for the Public Sector') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6 col-sm-12 col-12 text-card mb-4">
            <div class="main-cards">
              <div class="card-header-section">
                <h5>{{ $page->t("Simple, Secure and Affordable Digital Signature?")}}</h5>
              </div>
              <div class="card-icon-section">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/digital-signature.svg" alt="" />
              </div>
              <div class="card-description-section">
                <p>
                  {{ $page->t("Optimize your workflows, strengthen governance, and reduce operational costs without sacrificing security or ease of use.") }}
                </p>
              </div>
              <div class="card-button-section">
                <ul class="ud-hero-buttons">
                  <li>
                    <a href="{{ locale_url($page, 'company-solutions') }}" class="ud-main-btn">
                      {{ $page->t('Discover Solutions for Your Company.') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6 col-sm-12 col-12 text-card mb-4">
            <div class="main-cards">
              <div class="card-header-section">
                <h5>{{ $page->t("Total Control and Flexibility to Integrate?")}}</h5>
              </div>
              <div class="card-icon-section">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/integration-flexibility.svg" alt="" />
              </div>
              <div class="card-description-section">
                <p>
                  {{ $page->t("Easily integrate, customize to your needs, and enjoy the freedom of a robust, scalable architecture under your control.") }}
                </p>
              </div>
              <div class="card-button-section">
                <ul class="ud-hero-buttons">
                  <li>
                    <a href="{{ locale_url($page, 'tecnical-details') }}" class="ud-main-btn">
                      {{ $page->t('Technical Details for IT.') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ====== Features Start ====== -->
    <section class="ud-features">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="card-title fs-1 fw-bold">{{ $page->t("Unlock the Future of Your Management: The Exclusive Benefits of LibreSign.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="card-subtitle">{{ $page->t("More than a tool, a strategic partner for digital efficiency and security.") }}</p>
          </div>
        </div>
        <div class="row text-center gy-5">
          <div class="col-md-6 col-sm-12 col-12 text-card d-flex justify-content-center">
            <div class="main-cards">
              <div class="card-header-section">
                <h5>{{ $page->t("Advanced Security")}}</h5>
              </div>
              <div class="card-icon-section">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/advanced-security.svg" alt="" />
              </div>
              <div class="card-description-section">
                <p>
                  {{ $page->t("Keep your documents secure with end-to-end encryption and multi-layer authentication, ensuring protection throughout the entire electronic document signing process.") }}
                </p>
              </div>
              <div class="card-button-section">
                <ul class="ud-hero-buttons">
                  <li>
                    <a href="{{ locale_url($page, 'advantages') }}" class="ud-main-btn">
                      {{ $page->t('Explore all the advantages of LibreSign') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-12 text-card d-flex justify-content-center">
            <div class="main-cards">
              <div class="card-header-section">
                <h5>{{ $page->t("Hybrid Signatures")}}</h5>
              </div>
              <div class="card-icon-section">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/hybrid-signatures.svg" alt="" />
              </div>
              <div class="card-description-section">
                <p>
                  {{ $page->t("Hybrid signatures simplify negotiation processes by offering flexibility in choosing between personal or system-generated digital certificates to digitally sign documents with LibreSign.") }}
                </p>
              </div>
              <div class="card-button-section">
                <ul class="ud-hero-buttons">
                  <li>
                    <a href="{{ locale_url($page, 'advantages') }}" class="ud-main-btn">
                      {{ $page->t('Explore all the advantages of LibreSign') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-12 text-card d-flex justify-content-center">
            <div class="main-cards">
              <div class="card-header-section">
                <h5>{{ $page->t("Real-Time Monitoring.")}}</h5>
              </div>
              <div class="card-icon-section">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/realtime-monitoring.svg" alt="" />
              </div>
              <div class="card-description-section">
                <p>
                  {{ $page->t("Transform document management in public organizations with LibreSign, monitoring signatures in real time, sending automatic reminders, and optimizing your team's efficiency. Try our solution for transparent and productive administration.") }}
                </p>
              </div>
              <div class="card-button-section">
                <ul class="ud-hero-buttons">
                  <li>
                    <a href="{{ locale_url($page, 'advantages') }}" class="ud-main-btn">
                      {{ $page->t('Explore all the advantages of LibreSign') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-12 text-card d-flex justify-content-center">
            <div class="main-cards">
              <div class="card-header-section">
                <h5>{{ $page->t("QR Code validation")}}</h5>
              </div>
              <div class="card-icon-section">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/qrcode-validation.svg" alt="" />
              </div>
              <div class="card-description-section">
                <p>
                  {{ $page->t("Perform document authenticity verification using QR codes, ensuring security, efficiency, and convenience. Its instant validation, speed, transparency, and compatibility with various platforms make it perfect for sustainable businesses.") }}
                </p>
              </div>
              <div class="card-button-section">
                <ul class="ud-hero-buttons">
                  <li>
                    <a href="{{ locale_url($page, 'advantages') }}" class="ud-main-btn">
                      {{ $page->t('Explore all the advantages of LibreSign') }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Features End ====== -->

    <!-- ====== Solutions Section Start ====== -->
    <section class="ud-solutions">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="card-title fs-1 fw-bold">{{ $page->t("Tailored Solutions: LibreSign Meets the Unique Demands of Your Business.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="card-subtitle">{{ $page->t("Developed with expertise to optimize processes across various segments.") }}</p>
          </div>
        </div>
        <div class="row text-center justify-content-center gy-5">
          <div class="col-lg col-md-6 col-sm-12">
            <div class="solution-card">
              <div class="solution-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/public-sector.svg" alt="" />
              </div>
              <h4>{{ $page->t("Public Management: Transparency, Validity, and Efficiency")}}</h4>
              <p>{{ $page->t("Digitize bids, contracts, and administrative processes with total compliance and agility, respecting public value.") }}</p>
              <a href="{{ locale_url($page, 'public-sector') }}" class="ud-main-btn">
                {{ $page->t('Discover the Perfect Solution for the Public Sector') }}
              </a>
            </div>
          </div>
          <div class="col-lg col-md-6 col-sm-12">
            <div class="solution-card">
              <div class="solution-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/small-business.svg" alt="" />
              </div>
              <h4>{{ $page->t("Small and Medium Businesses: Grow with Security")}}</h4>
              <p>{{ $page->t("Optimize contracts, reduce costs, and ensure the legal validity of your commercial agreements, streamlining your business.") }}</p>
              <a href="{{ locale_url($page, 'company-solutions') }}" class="ud-main-btn">
                {{ $page->t('Discover the Perfect Solution for Small and Medium Businesses') }}
              </a>
            </div>
          </div>
          <div class="col-lg col-md-6 col-sm-12">
            <div class="solution-card">
              <div class="solution-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/cooperatives.svg" alt="" />
              </div>
              <h4>{{ $page->t("Cooperatives: Strengthen Governance and Member Participation")}}</h4>
              <p>{{ $page->t("Digitize assemblies and internal processes, promoting transparency, collaboration, and alignment with your cooperative values.") }}</p>
              <a href="{{ locale_url($page, 'cooperatives') }}" class="ud-main-btn">
                {{ $page->t('Discover the Perfect Solution for Cooperatives') }}
              </a>
            </div>
          </div>
          <div class="col-lg col-md-6 col-sm-12">
            <div class="solution-card">
              <div class="solution-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/it-professionals.svg" alt="" />
              </div>
              <h4>{{ $page->t("Information Technology: Control and Total Flexibility")}}</h4>
              <p>{{ $page->t("Integrate, customize, and scale a robust, open-source solution with autonomy that your infrastructure demands.") }}</p>
              <a href="{{ locale_url($page, 'tecnical-details') }}" class="ud-main-btn">
                {{ $page->t('Discover the Perfect Solution for IT Professionals') }}
              </a>
            </div>
          </div>
          <div class="col-lg col-md-6 col-sm-12">
            <div class="solution-card">
              <div class="solution-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/legal-sector.svg" alt="" />
              </div>
              <h4>{{ $page->t("Legal Sector: Agility and Unquestionable Legal Security")}}</h4>
              <p>{{ $page->t("Ensure the legal validity of each signature and simplify document management, with total protection for confidential information.") }}</p>
              <a href="{{ locale_url($page, 'lawyers') }}" class="ud-main-btn">
                {{ $page->t('Discover the Perfect Solution for Lawyers') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Solutions Section End ====== -->

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
            <img src="{{ $page->baseUrl }}assets/images/about/about-image.svg" alt="" />
          </div>
        </div>
      </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Video Demo Section Start ====== -->
    <section class="ud-video-demo">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="card-title fs-1 fw-bold text-white">{{ $page->t("See LibreSign in Action: Simplify Your Signatures in Detail.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="card-subtitle text-white">{{ $page->t("Our complete video guide shows how to sign, manage, and validate documents step by step, in an easy and secure way.") }}</p>
          </div>
        </div>
        <div class="row justify-content-center mt-5">
          <div class="col-lg-6 text-center">
            <div class="video-demo-image">
              <img src="{{ $page->baseUrl }}assets/images/demo/mobile-demo.png" alt="{{ $page->t('LibreSign mobile application demo') }}" />
            </div>
            <div class="mt-4">
              <a href="#" class="ud-main-btn ud-demo-btn">
                {{ $page->t('See How It Works') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Video Demo Section End ====== -->

    @include('_partials/testimonial_card')

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
            <img src="{{ $page->baseUrl }}assets/images/mobile_libresign.png" alt=""/>
          </div>
          <div class="col-lg-12 d-flex justify-content-center mt-5">
            <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn ud-border-btn">
              {{ $page->t('Talk to sales') }}
            </a>
          </div>
        </div>
      </div>

    </section>
    <!-- ====== End Importance of digital signature ====== -->

    <!-- ====== Blog/Content Section Start ====== -->
    <section class="ud-blog-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="card-title fs-1 fw-bold">{{ $page->t("LibreSign: Knowledge that Drives Your Digital Transformation.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="card-subtitle">{{ $page->t("Explore articles, guides, and insights about GDPR, technology, management, and the world of electronic signatures.") }}</p>
          </div>
        </div>
        <div class="row gy-4 mt-4">
          <div class="col-lg-4 col-md-6">
            <div class="blog-card">
              <div class="blog-image">
                <img src="{{ $page->baseUrl }}assets/images/blog/digital-signature-article.jpg" alt="{{ $page->t('Digital signature article') }}" />
                <span class="blog-tag">{{ $page->t('Digital Signature') }}</span>
              </div>
              <div class="blog-content">
                <h4>{{ $page->t("Digital document signature: see real situations where digital signature transforms contracts")}}</h4>
                <p>{{ $page->t("Digital signature has become an essential tool in the corporate, legal, and even personal world. More than a trend, it represents a definitive change in the way we deal with documents...") }}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-card">
              <div class="blog-image">
                <img src="{{ $page->baseUrl }}assets/images/blog/digital-signature-myths.jpg" alt="{{ $page->t('Digital signature myths') }}" />
                <span class="blog-tag">{{ $page->t('Digital Signature') }}</span>
              </div>
              <div class="blog-content">
                <h4>{{ $page->t("4 doubts about digital signature: Learn about the common myths created about this term")}}</h4>
                <p>{{ $page->t("To help you clarify the most frequent doubts about digital signature, our specialists answer some questions raised through social media and public forums. Check it now and learn how digital signature can transform your life...") }}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="blog-card">
              <div class="blog-image">
                <img src="{{ $page->baseUrl }}assets/images/blog/how-to-create-signature.jpg" alt="{{ $page->t('How to create digital signature') }}" />
                <span class="blog-tag">{{ $page->t('Digital Signature') }}</span>
              </div>
              <div class="blog-content">
                <h4>{{ $page->t("How to create a digital signature: learn the step-by-step process of how to do it")}}</h4>
                <p>{{ $page->t("How about saying goodbye to paper, unnecessary travel to the notary, and waiting times? Digital transformation made office workflows more streamlined than ever. The digital signature market has become increasingly...") }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog/Content Section End ====== -->

    <!-- ====== FAQ Start ====== -->
    <section id="faq" class="ud-faq">
      <div class="shape">
        <img src="{{ $page->baseUrl }}assets/images/faq/shape.svg" alt="" />
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
