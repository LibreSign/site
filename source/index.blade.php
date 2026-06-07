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
          'class' => 'btn ud-btn-solid-amber ud-btn-lg w-100 text-center',
        ],
        [
          'href' => locale_url($page, 'contact-us'),
          'label' => $page->t('Talk to Our Experts'),
          'class' => 'btn ud-btn-ghost w-100 text-center',
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
    @include('_partials.post-list', [
      'sectionClass' => 'ud-home-benefits',
      'title'        => $page->t('Unlock the Future of Your Management: The Exclusive Benefits of LibreSign.'),
      'subtitle'     => $page->t('More than a tool, a strategic partner for digital efficiency and security.'),
      'category'     => 'destaque',
      'format'       => 'feature',
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
              <a href="#" class="btn ud-btn-solid-warm ud-home-video__action">
                {{ $page->t('See How It Works') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Video Demo Section End ====== -->

    <!-- ====== Solutions Section Start ====== -->
    @php
      $homeSolutionItems = [
        [
          'title' => $page->t('Public Management: Transparency, Validity, and Efficiency'),
          'icon'  => $page->baseUrl . 'assets/images/icon/solutions/public-sector.png',
          'body'  => $page->t('Digitize bids, contracts, and administrative processes with total compliance and agility, respecting public value.'),
          'actions' => [['href' => locale_url($page, 'public-sector'), 'label' => $page->t('Discover the Perfect Solution for the Public Sector')]],
        ],
        [
          'title' => $page->t('Small and Medium Businesses: Grow with Security'),
          'icon'  => $page->baseUrl . 'assets/images/icon/solutions/small-business.png',
          'body'  => $page->t('Optimize contracts, reduce costs, and ensure the legal validity of your commercial agreements, streamlining your business.'),
          'actions' => [['href' => locale_url($page, 'company-solutions'), 'label' => $page->t('Discover the Perfect Solution for Small and Medium Businesses')]],
        ],
        [
          'title' => $page->t('Cooperatives: Strengthen Governance and Member Participation'),
          'icon'  => $page->baseUrl . 'assets/images/icon/solutions/cooperatives.png',
          'body'  => $page->t('Digitize assemblies and internal processes, promoting transparency, collaboration, and alignment with your cooperative values.'),
          'actions' => [['href' => locale_url($page, 'cooperatives'), 'label' => $page->t('Discover the Perfect Solution for Cooperatives')]],
        ],
        [
          'title' => $page->t('Information Technology: Control and Total Flexibility'),
          'icon'  => $page->baseUrl . 'assets/images/icon/solutions/it-professionals.png',
          'body'  => $page->t('Integrate, customize, and scale a robust, open-source solution with autonomy that your infrastructure demands.'),
          'actions' => [['href' => locale_url($page, 'tecnical-details'), 'label' => $page->t('Discover the Perfect Solution for IT Professionals')]],
        ],
        [
          'title' => $page->t('Legal Sector: Agility and Unquestionable Legal Security'),
          'icon'  => $page->baseUrl . 'assets/images/icon/solutions/legal-sector.png',
          'body'  => $page->t('Ensure the legal validity of each signature and simplify document management, with total protection for confidential information.'),
          'actions' => [['href' => locale_url($page, 'lawyers'), 'label' => $page->t('Discover the Perfect Solution for Lawyers')]],
        ],
      ];
    @endphp
    @include('_partials.home.card-grid-section', [
      'sectionClass' => 'ud-home-solutions',
      'title'        => $page->t('Tailored Solutions: LibreSign Meets the Unique Demands of Your Business.'),
      'subtitle'     => $page->t('Developed with expertise to optimize processes across various segments.'),
      'items'        => $homeSolutionItems,
      'rowClass'     => 'row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center align-items-stretch',
      'colClass'     => 'col d-flex',
    ])
    <!-- ====== Solutions Section End ====== -->

    <!-- ====== Blog/Content Section Start ====== -->
    @include('_partials.post-list', [
      'sectionClass' => 'ud-home-blog',
      'title'        => $page->t('LibreSign: Knowledge that Drives Your Digital Transformation.'),
      'subtitle'     => $page->t('Explore articles, guides, and insights about GDPR, technology, management, and the world of electronic signatures.'),
      'format'       => 'blog',
      'limit'        => 3,
      'cta'          => ['href' => locale_url($page, 'posts'), 'label' => $page->t('Access Our Full Blog')],
    ])
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
