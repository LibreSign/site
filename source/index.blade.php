@extends('_layouts.main')

@section('body')

 <!-- ====== Princiapl Banner Start ====== -->
    <section class="ud-hero">
      <div class="ud-hero-image wow fadeInUp" data-aos-delay=".3s">
        <img src="{{ $page->baseUrl }}assets/images/hero/hero-image.png" alt="{{ $page->t('Professional using digital signature') }}" />
      </div>
      <div class="container">
        <div class="row">
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
        </div>
      </div>
    </section>
    <!-- ====== Princiapl Banner End ====== -->

    <section class="clients">
      <div class="container">
        <div class="row">
          <div class="col-12 headline clients-headline">
            <p>{{ $page->t("Validated Trust: LibreSign Solutions from Those Who Understand Governance and Efficiency.") }}</p>
          </div>
        </div>
        <div class="row logos clients-logos g-5 justify-content-evenly">
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
          <div class="secondary clients-secondary">
            @php
              $clientsSignedDocumentsMillions = (string) ($page->signedDocumentsMillions ?? 'X');
              $clientsSecondaryTemplate = $page->t('More than <strong>:count million</strong> documents signed securely and with legal validity.');
              $clientsSecondaryWithCount = str_replace(':count', $clientsSignedDocumentsMillions, $clientsSecondaryTemplate);
              $clientsSecondaryParts = explode('<strong>', $clientsSecondaryWithCount, 2);
              $clientsSecondaryStrongParts = count($clientsSecondaryParts) === 2 ? explode('</strong>', $clientsSecondaryParts[1], 2) : [];
            @endphp
            <p class="animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
              @if (count($clientsSecondaryParts) === 2 && count($clientsSecondaryStrongParts) === 2)
                {{ $clientsSecondaryParts[0] }}<span class="clients-highlight animate__animated animate__pulse" style="animation-delay: 0.6s;"><strong>{{ $clientsSecondaryStrongParts[0] }}</strong></span>{{ $clientsSecondaryStrongParts[1] }}
              @else
                {{ $clientsSecondaryWithCount }}
              @endif
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ====== Target Audience Start ====== -->
    <section class="ud-about ud-about-challenges" data-aos="fade-up">
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
        <div class="row text-center justify-content-evenly gy-5">
          <div class="col-lg-4 col-md-6 col-sm-12 col-12 text-card mb-4" data-aos="fade-up" data-aos-delay="0">
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
          <div class="col-lg-4 col-md-6 col-sm-12 col-12 text-card mb-4" data-aos="fade-up" data-aos-delay="150">
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
          <div class="col-lg-4 col-md-6 col-sm-12 col-12 text-card mb-4" data-aos="fade-up" data-aos-delay="300">
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
    <section class="ud-features" data-aos="fade-up">
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
          <div class="col-md-6 col-sm-12 col-12 text-card d-flex justify-content-center" data-aos="fade-up" data-aos-delay="0">
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
          <div class="col-md-6 col-sm-12 col-12 text-card d-flex justify-content-center" data-aos="fade-up" data-aos-delay="150">
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
          <div class="col-md-6 col-sm-12 col-12 text-card d-flex justify-content-center" data-aos="fade-up" data-aos-delay="300">
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

    <!-- ====== Video Demo Section Start ====== -->
    <section class="ud-video-demo" data-aos="fade-up">
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
              <img src="{{ $page->baseUrl }}assets/images/libresign_mobile_acess_oficial.png" alt="{{ $page->t('LibreSign mobile application demo') }}" />
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

    <!-- ====== Solutions Section Start ====== -->
    <section class="ud-solutions" data-aos="fade-up">
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
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/public-sector.png" alt="" />
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
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/small-business.png" alt="" />
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
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/cooperatives.png" alt="" />
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
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/it-professionals.png" alt="" />
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
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/legal-sector.png" alt="" />
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

    <!-- ====== Blog/Content Section Start ====== -->
    <section class="ud-blog-section" data-aos="fade-up">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="ud-blog-section__header text-center mx-auto">
              <h3 class="ud-blog-section__title">{{ $page->t("LibreSign: Knowledge that Drives Your Digital Transformation.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="ud-blog-section__subtitle">{{ $page->t("Explore articles, guides, and insights about GDPR, technology, management, and the world of electronic signatures.") }}</p>
          </div>
        </div>
        <div class="row g-4 mt-4 justify-content-center">
          @php
            $homePosts = $page->mergeCollections($posts, $posts_wordpress)
              ->filter(fn ($post) => current_path_locale($post) === current_path_locale($page))
              ->take(3);

            $categoryMap = [
              'features' => 'Features',
              'security' => 'Security',
              'article' => 'Article',
            ];
          @endphp

          @foreach ($homePosts as $post)
            @php
              $categories = $post->categories ?? [];
              $rawCategory = is_array($categories) && !empty($categories)
                ? $categories[0]
                : ($post->category ?? 'article');

              $categoryKey = is_string($rawCategory) ? strtolower($rawCategory) : 'article';
              $categoryLabel = $categoryMap[$categoryKey] ?? \Illuminate\Support\Str::headline(str_replace(['-', '_'], ' ', $categoryKey));

              if (($post->author ?? null) === 'LibreSign') {
                $authorAvatar = $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png';
              } elseif (!empty($post->gravatar ?? null) && str_starts_with($post->gravatar, '/')) {
                $authorAvatar = $page->baseUrl . ltrim($post->gravatar, '/');
              } elseif (!empty($post->gravatar ?? null)) {
                $authorAvatar = 'https://www.gravatar.com/avatar/' . $post->gravatar . '?size=80';
              } else {
                $authorAvatar = $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png';
              }
            @endphp

            <div class="col-lg-4 col-md-6">
              <article class="blog-card">
                <div class="blog-card__media">
                  <div class="blog-card__frame">
                    <img src="{{ $post->cover_image }}" alt="{{ $page->t($post->title) }}" />
                  </div>
                  <span class="blog-card__category">{{ $page->t($categoryLabel) }}</span>
                  <span class="blog-card__badge" aria-hidden="true">
                    <img src="{{ $authorAvatar }}" alt="" />
                  </span>
                </div>
                <div class="blog-card__content">
                  <h4>{{ $page->t($post->title) }}</h4>
                  <p>{{ $page->t($post->description) }}</p>
                  <a href="{{ $post->getUrl() }}" class="blog-card__link">{{ $page->t('Read more »') }}</a>
                </div>
              </article>
            </div>
          @endforeach
        </div>
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <a href="{{ locale_url($page, 'posts') }}" class="blog-cta-btn">{{ $page->t('Access Our Full Blog') }}</a>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog/Content Section End ====== -->

    <!-- ====== CTA Start ====== -->
    <section class="ud-cta-section" data-aos="fade-up">
      <div class="container">
        <div class="ud-cta-section__content wow fadeInUp" data-aos-delay=".2s">
          <h2>{{ $page->t('Don’t wait any longer: simplify your document workflows with LibreSign.') }}</h2>
          <p>{{ $page->t('Thousands of organizations already trust our digital signature technology. Be the next to transform your processes.') }}</p>

          <div class="ud-cta-section__actions">
            <a href="{{ locale_url($page, 'contact-us') }}" class="ud-cta-section__btn ud-cta-section__btn--primary">
              {{ $page->t('Request your personalized demo') }}
            </a>
            <a href="{{ locale_url($page, 'register') }}" class="ud-cta-section__btn ud-cta-section__btn--secondary">
              {{ $page->t('Try LibreSign now (free trial)') }}
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== CTA End ====== -->
@endsection
