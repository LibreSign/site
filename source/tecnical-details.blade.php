@extends('_layouts.main')

@section('body')
  @php
    $itPillarItems = [
      [
        'title' => $page->t('API REST Integration'),
        'icon' => $page->baseUrl . 'assets/images/solutions/it-api-icon.png',
        'body' => $page->t('Use complete documentation and RESTful APIs to integrate digital signatures into any system, ERP, or custom application.'),
      ],
      [
        'title' => $page->t('Security and Compliance'),
        'icon' => $page->baseUrl . 'assets/images/solutions/it-security-icon.png',
        'body' => $page->t('Protect your data with advanced encryption and ICP-Brasil standards, ensuring legal validity and full security control.'),
      ],
      [
        'title' => $page->t('Open Source Solution'),
        'icon' => $page->baseUrl . 'assets/images/solutions/it-open-source-icon.png',
        'body' => $page->t('Leverage the flexibility of open-source software to audit, customize, and scale the platform according to your environment.'),
      ],
    ];

    $itValueItems = [
      [
        'title' => $page->t('Total API Control'),
        'image' => $page->baseUrl . 'assets/images/solutions/it-workflow-screen.png',
        'body' => $page->t('Integrate smoothly with an intuitive and well-documented REST API that gives your team automation and end-to-end workflow control.'),
      ],
      [
        'title' => $page->t('Proactive Security'),
        'image' => $page->baseUrl . 'assets/images/solutions/it-compliance-screen.png',
        'body' => $page->t('Ensure compliance with detailed audit logs and a security panel that gives complete real-time visibility.'),
      ],
      [
        'title' => $page->t('Total Flexibility'),
        'image' => $page->baseUrl . 'assets/images/solutions/it-control-screen.png',
        'body' => $page->t('Adapt the solution to your ecosystem with scalability and compatibility across your current stack and tools.'),
      ],
    ];
  @endphp

  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/it-hero.png')",
    'title' => $page->t('Digital Signatures: Open Control and Technology for IT Teams.'),
    'description' => $page->t('From integration to security, give your team the freedom to build with robust architecture, powerful APIs, and full governance.'),
    'actions' => [
      [
        'href' => '#it-pillars',
        'label' => $page->t('Explore Technical Pillars'),
        'class' => 'ud-main-btn w-100 text-center',
      ],
      [
        'href' => '#it-architecture',
        'label' => $page->t('See the Architecture'),
        'class' => 'ud-secondary-btn w-100 text-center',
      ],
    ],
  ])

  <div class="ud-it-page">
    <section id="it-pillars" class="ud-it-pillars">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-10">
            <h3 class="ud-home-section__title">{{ $page->t('From Integration to Security: Freedom to Build.') }}</h3>
            <p class="ud-home-section__subtitle">
              {{ $page->t('Discover the technical pillars that give your team freedom to innovate with confidence, visibility, and governance.') }}
            </p>
          </div>
        </div>

        <div class="row text-center justify-content-evenly gy-5 align-items-stretch">
          @foreach ($itPillarItems as $item)
            <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up">
              <article class="ud-it-pillar-card">
                <div class="ud-it-pillar-card__icon">
                  <img src="{{ $item['icon'] }}" alt="" />
                </div>
                <h4 class="ud-it-pillar-card__title">{{ $item['title'] }}</h4>
                <p class="ud-it-pillar-card__body">{{ $item['body'] }}</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-it-pillars__actions text-center">
          <a href="#it-architecture" class="ud-main-btn ud-it-pillars__cta">
            {{ $page->t('Access API Documentation') }}
          </a>
        </div>
      </div>
    </section>

    <section id="it-architecture" class="ud-it-architecture">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-11">
            <h3 class="ud-it-architecture__title">{{ $page->t('Robust Architecture: Built to Scale.') }}</h3>
            <p class="ud-it-architecture__subtitle">
              {{ $page->t('Discover the technology that guarantees performance, flexibility, and complete control over your digital signing workflows.') }}
            </p>
          </div>
        </div>

        <div class="row gy-4 justify-content-center">
          @foreach ($itValueItems as $item)
            <div class="col-xl-4 col-md-6 d-flex">
              <article class="ud-it-architecture-card">
                <div class="ud-it-architecture-card__media">
                  <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" />
                </div>
                <h4 class="ud-it-architecture-card__title">{{ $item['title'] }}</h4>
                <p class="ud-it-architecture-card__body">{{ $item['body'] }}</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-it-architecture__actions">
          <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn ud-it-architecture__btn ud-it-architecture__btn--primary">
            {{ $page->t('Talk to a Solutions Architect') }}
          </a>
          <a href="{{ $page->baseUrl }}assets/images/solutions/it-architecture-image.png" class="ud-secondary-btn ud-it-architecture__btn ud-it-architecture__btn--secondary" target="_blank" rel="noopener noreferrer">
            {{ $page->t('Download Architecture Whitepaper') }}
          </a>
          <a href="https://github.com/LibreSign/libresign" class="ud-secondary-btn ud-it-architecture__btn ud-it-architecture__btn--secondary" target="_blank" rel="noopener noreferrer">
            {{ $page->t('Project on GitHub') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection
