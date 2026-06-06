@extends('_layouts.main')

@section('body')

 <!-- ====== Principal Banner Start ====== -->
    @include('_partials.home.hero-section', [
      'imageSrc' => $page->baseUrl . 'assets/images/hero/hero-image.png',
      'imageAlt' => $page->t('Professional using digital signature'),
      'title' => $page->t('The secure and legally binding digital signature for your world.'),
      'description' => $page->t('Reduce bureaucracy and speed up your processes: sign, manage, and validate documents with technology you control.'),
      'actions' => [
        [
          'href' => locale_url($page, 'contact-us'),
          'label' => $page->t('Try it For Free Now!'),
          'class' => 'ud-main-btn w-100 text-center',
        ],
        [
          'href' => locale_url($page, 'contact-us'),
          'label' => $page->t('Talk to Our Experts'),
          'class' => 'ud-secondary-btn w-100 text-center',
        ],
      ],
    ])
    <!-- ====== Principal Banner End ====== -->

    <section class="ud-home-clients">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p class="ud-home-clients__headline">{{ $page->t("Validated Trust: LibreSign Solutions from Those Who Understand Governance and Efficiency.") }}</p>
          </div>
        </div>
        <div class="row g-5 justify-content-evenly ud-home-clients__logos">
          <div class="col-12 col-md-auto ud-home-clients__logo-item">
            <img width="264px" src="{{ $page->baseUrl }}assets/images/logo/clients/ocb.png" alt="Sistema OCB/RJ">
          </div>
          <div class="col-12 col-md-auto ud-home-clients__logo-item">
            <img width="256px" src="{{ $page->baseUrl }}assets/images/logo/clients/oab.png" alt="OAB|ESA">
          </div>
          <div class="col-12 col-md-auto ud-home-clients__logo-item">
            <img width="80px" src="{{ $page->baseUrl }}assets/images/logo/clients/fiocruz.png" alt="Fiocruz">
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="ud-home-clients__summary">
            @php
              $clientsSignedDocumentsMillions = (string) ($page->signedDocumentsMillions ?? 'X');
              $clientsSecondaryTemplate = $page->t('More than <strong>:count million</strong> documents signed securely and with legal validity.');
              $clientsSecondaryWithCount = str_replace(':count', $clientsSignedDocumentsMillions, $clientsSecondaryTemplate);
              $clientsSecondaryParts = explode('<strong>', $clientsSecondaryWithCount, 2);
              $clientsSecondaryStrongParts = count($clientsSecondaryParts) === 2 ? explode('</strong>', $clientsSecondaryParts[1], 2) : [];
            @endphp
            <p class="ud-home-clients__summary-text animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
              @if (count($clientsSecondaryParts) === 2 && count($clientsSecondaryStrongParts) === 2)
                {{ $clientsSecondaryParts[0] }}<span class="ud-home-clients__highlight animate__animated animate__pulse" style="animation-delay: 0.6s;"><strong>{{ $clientsSecondaryStrongParts[0] }}</strong></span>{{ $clientsSecondaryStrongParts[1] }}
              @else
                {{ $clientsSecondaryWithCount }}
              @endif
            </p>
          </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ====== Challenges Section Start ====== -->
    @php
      $homeChallengeItems = [
        [
          'title' => $page->t('Legal Validity and Undisputed Compliance?'),
          'icon' => $page->baseUrl . 'assets/images/icon/features/legal-validity.svg',
          'body' => $page->t('Minimize risks and ensure the authenticity of each document with electronic signatures that fully comply with the LGPD and current legislation.'),
          'actions' => [[
            'href' => locale_url($page, 'public-sector'),
            'label' => $page->t('Learn More for the Public Sector'),
          ]],
        ],
        [
          'title' => $page->t('Simple, Secure and Affordable Digital Signature?'),
          'icon' => $page->baseUrl . 'assets/images/icon/features/digital-signature.svg',
          'body' => $page->t('Optimize your workflows, strengthen governance, and reduce operational costs without sacrificing security or ease of use.'),
          'actions' => [[
            'href' => locale_url($page, 'company-solutions'),
            'label' => $page->t('Discover Solutions for Your Company.'),
          ]],
        ],
        [
          'title' => $page->t('Total Control and Flexibility to Integrate?'),
          'icon' => $page->baseUrl . 'assets/images/icon/features/integration-flexibility.svg',
          'body' => $page->t('Easily integrate, customize to your needs, and enjoy the freedom of a robust, scalable architecture under your control.'),
          'actions' => [[
            'href' => locale_url($page, 'tecnical-details'),
            'label' => $page->t('Technical Details for IT.'),
          ]],
        ],
      ];
    @endphp
    @include('_partials.home.card-grid-section', [
      'sectionClass' => 'ud-home-challenges',
      'title' => $page->t("Eliminate Bureaucracy, Ensure Security: LibreSign Solves Your Biggest Challenges."),
      'subtitle' => $page->t("We understand the complexities of each industry. See how our platform is the answer you're looking for."),
      'items' => $homeChallengeItems,
    ])
    <!-- ====== Challenges Section End ====== -->

    <!-- ====== Benefits Start ====== -->
    @php
      $homeBenefitItems = [
        [
          'colClass' => 'col-md-6 d-flex',
          'title' => $page->t('Advanced Security'),
          'icon' => $page->baseUrl . 'assets/images/icon/features/advanced-security.svg',
          'body' => $page->t('Keep your documents secure with end-to-end encryption and multi-layer authentication, ensuring protection throughout the entire electronic document signing process.'),
          'actions' => [[
            'href' => locale_url($page, 'advantages'),
            'label' => $page->t('Explore all the advantages of LibreSign'),
          ]],
        ],
        [
          'colClass' => 'col-md-6 d-flex',
          'title' => $page->t('Hybrid Signatures'),
          'icon' => $page->baseUrl . 'assets/images/icon/features/hybrid-signatures.svg',
          'body' => $page->t('Hybrid signatures simplify negotiation processes by offering flexibility in choosing between personal or system-generated digital certificates to digitally sign documents with LibreSign.'),
          'actions' => [[
            'href' => locale_url($page, 'advantages'),
            'label' => $page->t('Explore all the advantages of LibreSign'),
          ]],
        ],
        [
          'colClass' => 'col-md-6 d-flex',
          'title' => $page->t('Real-Time Monitoring.'),
          'icon' => $page->baseUrl . 'assets/images/icon/features/realtime-monitoring.svg',
          'body' => $page->t("Transform document management in public organizations with LibreSign, monitoring signatures in real time, sending automatic reminders, and optimizing your team's efficiency. Try our solution for transparent and productive administration."),
          'actions' => [[
            'href' => locale_url($page, 'advantages'),
            'label' => $page->t('Explore all the advantages of LibreSign'),
          ]],
        ],
        [
          'colClass' => 'col-md-6 d-flex',
          'title' => $page->t('QR Code validation'),
          'icon' => $page->baseUrl . 'assets/images/icon/features/qrcode-validation.svg',
          'body' => $page->t('Perform document authenticity verification using QR codes, ensuring security, efficiency, and convenience. Its instant validation, speed, transparency, and compatibility with various platforms make it perfect for sustainable businesses.'),
          'actions' => [[
            'href' => locale_url($page, 'advantages'),
            'label' => $page->t('Explore all the advantages of LibreSign'),
          ]],
        ],
      ];
    @endphp
    @include('_partials.home.card-grid-section', [
      'sectionClass' => 'ud-home-benefits',
      'title' => $page->t('Unlock the Future of Your Management: The Exclusive Benefits of LibreSign.'),
      'subtitle' => $page->t('More than a tool, a strategic partner for digital efficiency and security.'),
      'items' => $homeBenefitItems,
      'rowClass' => 'row text-center gy-5 align-items-stretch',
    ])
    <!-- ====== Benefits End ====== -->

    <!-- ====== Video Demo Section Start ====== -->
    <section
      class="ud-home-video"
      data-aos="fade-up"
      style="--ud-home-video-bg: url('{{ $page->baseUrl }}assets/images/conection_wallpaper_mobile.png');"
    >
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="ud-home-section__title">{{ $page->t("See LibreSign in Action: Simplify Your Signatures in Detail.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="ud-home-section__subtitle">{{ $page->t("Our complete video guide shows how to sign, manage, and validate documents step by step, in an easy and secure way.") }}</p>
          </div>
        </div>
        <div class="row justify-content-center mt-5">
          <div class="col-lg-6 text-center">
            <div class="ud-home-video__media">
              <img src="{{ $page->baseUrl }}assets/images/libresign_mobile_acess_oficial.png" alt="{{ $page->t('LibreSign mobile application demo') }}" />
            </div>
            <div class="mt-4">
              <a href="#" class="ud-main-btn ud-home-video__action">
                {{ $page->t('See How It Works') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Video Demo Section End ====== -->

    <!-- ====== Solutions Section Start ====== -->
    <section class="ud-home-solutions" data-aos="fade-up">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="ud-home-section__title">{{ $page->t("Tailored Solutions: LibreSign Meets the Unique Demands of Your Business.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="ud-home-section__subtitle">{{ $page->t("Developed with expertise to optimize processes across various segments.") }}</p>
          </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center align-items-stretch">
          <div class="col d-flex">
            <div class="ud-home-solution-card">
              <div class="ud-home-solution-card__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/public-sector.png" alt="" />
              </div>
              <h4 class="ud-home-solution-card__title">{{ $page->t("Public Management: Transparency, Validity, and Efficiency")}}</h4>
              <p class="ud-home-solution-card__body">{{ $page->t("Digitize bids, contracts, and administrative processes with total compliance and agility, respecting public value.") }}</p>
              <a href="{{ locale_url($page, 'public-sector') }}" class="ud-main-btn ud-home-solution-card__action">
                {{ $page->t('Discover the Perfect Solution for the Public Sector') }}
              </a>
            </div>
          </div>
          <div class="col d-flex">
            <div class="ud-home-solution-card">
              <div class="ud-home-solution-card__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/small-business.png" alt="" />
              </div>
              <h4 class="ud-home-solution-card__title">{{ $page->t("Small and Medium Businesses: Grow with Security")}}</h4>
              <p class="ud-home-solution-card__body">{{ $page->t("Optimize contracts, reduce costs, and ensure the legal validity of your commercial agreements, streamlining your business.") }}</p>
              <a href="{{ locale_url($page, 'company-solutions') }}" class="ud-main-btn ud-home-solution-card__action">
                {{ $page->t('Discover the Perfect Solution for Small and Medium Businesses') }}
              </a>
            </div>
          </div>
          <div class="col d-flex">
            <div class="ud-home-solution-card">
              <div class="ud-home-solution-card__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/cooperatives.png" alt="" />
              </div>
              <h4 class="ud-home-solution-card__title">{{ $page->t("Cooperatives: Strengthen Governance and Member Participation")}}</h4>
              <p class="ud-home-solution-card__body">{{ $page->t("Digitize assemblies and internal processes, promoting transparency, collaboration, and alignment with your cooperative values.") }}</p>
              <a href="{{ locale_url($page, 'cooperatives') }}" class="ud-main-btn ud-home-solution-card__action">
                {{ $page->t('Discover the Perfect Solution for Cooperatives') }}
              </a>
            </div>
          </div>
          <div class="col d-flex">
            <div class="ud-home-solution-card">
              <div class="ud-home-solution-card__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/it-professionals.png" alt="" />
              </div>
              <h4 class="ud-home-solution-card__title">{{ $page->t("Information Technology: Control and Total Flexibility")}}</h4>
              <p class="ud-home-solution-card__body">{{ $page->t("Integrate, customize, and scale a robust, open-source solution with autonomy that your infrastructure demands.") }}</p>
              <a href="{{ locale_url($page, 'tecnical-details') }}" class="ud-main-btn ud-home-solution-card__action">
                {{ $page->t('Discover the Perfect Solution for IT Professionals') }}
              </a>
            </div>
          </div>
          <div class="col d-flex">
            <div class="ud-home-solution-card">
              <div class="ud-home-solution-card__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/solutions/legal-sector.png" alt="" />
              </div>
              <h4 class="ud-home-solution-card__title">{{ $page->t("Legal Sector: Agility and Unquestionable Legal Security")}}</h4>
              <p class="ud-home-solution-card__body">{{ $page->t("Ensure the legal validity of each signature and simplify document management, with total protection for confidential information.") }}</p>
              <a href="{{ locale_url($page, 'lawyers') }}" class="ud-main-btn ud-home-solution-card__action">
                {{ $page->t('Discover the Perfect Solution for Lawyers') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Solutions Section End ====== -->

    <!-- ====== Blog/Content Section Start ====== -->
    <section class="ud-home-blog" data-aos="fade-up">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="ud-home-blog__header text-center mx-auto">
              <h3 class="ud-home-section__title">{{ $page->t("LibreSign: Knowledge that Drives Your Digital Transformation.")}}</h3>
            </div>
          </div>
          <div class="col-lg-12">
            <p class="ud-home-section__subtitle">{{ $page->t("Explore articles, guides, and insights about GDPR, technology, management, and the world of electronic signatures.") }}</p>
          </div>
        </div>
        <div class="row g-4 mt-4 justify-content-center align-items-stretch">
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

            <div class="col-lg-4 col-md-6 d-flex">
              <article class="ud-home-blog-card">
                <div class="ud-home-blog-card__media">
                  <div class="ud-home-blog-card__frame">
                    <img src="{{ $post->cover_image }}" alt="{{ $page->t($post->title) }}" />
                  </div>
                  <span class="ud-home-blog-card__category">{{ $page->t($categoryLabel) }}</span>
                  <span class="ud-home-blog-card__badge" aria-hidden="true">
                    <img src="{{ $authorAvatar }}" alt="" />
                  </span>
                </div>
                <div class="ud-home-blog-card__content">
                  <h4 class="ud-home-blog-card__title">{{ $page->t($post->title) }}</h4>
                  <p class="ud-home-blog-card__excerpt">{{ $page->t($post->description) }}</p>
                  <a href="{{ $post->getUrl() }}" class="ud-home-blog-card__link">{{ $page->t('Read more »') }}</a>
                </div>
              </article>
            </div>
          @endforeach
        </div>
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <a href="{{ locale_url($page, 'posts') }}" class="ud-home-blog__cta">{{ $page->t('Access Our Full Blog') }}</a>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog/Content Section End ====== -->

    <!-- ====== CTA Start ====== -->
    @include('_partials.home.cta-section', [
      'title' => $page->t('Don’t wait any longer: simplify your document workflows with LibreSign.'),
      'description' => $page->t('Thousands of organizations already trust our digital signature technology. Be the next to transform your processes.'),
      'actions' => [
        [
          'href' => locale_url($page, 'contact-us'),
          'label' => $page->t('Request your personalized demo'),
          'class' => 'ud-home-cta__btn ud-home-cta__btn--primary',
        ],
        [
          'href' => locale_url($page, 'register'),
          'label' => $page->t('Try LibreSign now (free trial)'),
          'class' => 'ud-home-cta__btn ud-home-cta__btn--secondary',
        ],
      ],
    ])
    <!-- ====== CTA End ====== -->
@endsection
