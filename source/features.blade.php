@extends('_layouts.main')

@section('body')
  @php
    $featureMainItems = [
      [
        'title'   => $page->t('Advanced Security'),
        'icon'    => $page->baseUrl . 'assets/images/solutions/features-security-icon.png',
        'body'    => $page->t('Keep your documents protected with strong encryption and multi-factor authentication across the entire electronic signing flow.'),
        'actions' => [['href' => locale_url($page, 'contact-us'), 'label' => $page->t('Learn more'), 'class' => 'ud-card__link']],
      ],
      [
        'title'   => $page->t('Hybrid Signatures'),
        'icon'    => $page->baseUrl . 'assets/images/solutions/features-hybrid-icon.png',
        'body'    => $page->t('Gain flexibility by choosing personal digital certificates or system-generated certificates to sign documents with LibreSign.'),
        'actions' => [['href' => locale_url($page, 'contact-us'), 'label' => $page->t('Learn more'), 'class' => 'ud-card__link']],
      ],
      [
        'title'   => $page->t('Real-Time Monitoring'),
        'icon'    => $page->baseUrl . 'assets/images/solutions/features-realtime-icon.png',
        'body'    => $page->t('Monitor signatures in real time and optimize your team’s efficiency with complete visibility over every document workflow.'),
        'actions' => [['href' => locale_url($page, 'contact-us'), 'label' => $page->t('Learn more'), 'class' => 'ud-card__link']],
      ],
      [
        'title'   => $page->t('QR Code Validation'),
        'icon'    => $page->baseUrl . 'assets/images/solutions/features-qrcode-icon.png',
        'body'    => $page->t('Simplify authenticity verification with QR Code validation, delivering security, speed, and convenience for all parties.'),
        'actions' => [['href' => locale_url($page, 'contact-us'), 'label' => $page->t('Learn more'), 'class' => 'ud-card__link']],
      ],
    ];
  @endphp

  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/features-hero.png')",
    'title' => $page->t('Innovation and Security on a Single Platform.'),
    'description' => $page->t('Explore the capabilities that transform digital document management and elevate security and efficiency across your organization.'),
    'actions' => [
      [
        'href' => '#feature-highlights',
        'label' => $page->t('Explore All Features'),
        'class' => 'ud-main-btn w-100 text-center',
      ],
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Talk to Our Specialists'),
        'class' => 'ud-secondary-btn w-100 text-center',
      ],
    ],
  ])

  <div class="ud-features-page">
    @include('_partials.home.card-grid-section', [
      'sectionId'    => 'feature-highlights',
      'sectionClass' => 'ud-features-highlights',
      'title'    => $page->t('Core Features That Power Your Business.'),
      'subtitle' => $page->t('LibreSign combines agility, security, and flexibility through capabilities that adapt to your organization’s specific needs.'),
      'items'    => $featureMainItems,
      'rowClass' => 'row text-center gy-5 align-items-stretch',
      'colClass' => 'col-lg-6 d-flex',
      'sectionActions' => [[
        'href'  => locale_url($page, 'pricing'),
        'label' => $page->t('View All Plans'),
        'class' => 'ud-main-btn ud-features-highlights__cta',
      ]],
    ])

    <section class="ud-features-cta">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-9">
            <h3 class="ud-features-cta__title">{{ $page->t('Ready to Transform Your Operations?') }}</h3>
            <p class="ud-features-cta__subtitle">
              {{ $page->t('Talk to our specialists or try LibreSign and raise your company’s security and efficiency standards.') }}
            </p>
          </div>
        </div>

        <div class="ud-features-cta__actions">
          <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn ud-features-cta__btn ud-features-cta__btn--primary">
            {{ $page->t('Talk to a Specialist') }}
          </a>
          <a href="{{ locale_url($page, 'register') }}" class="ud-secondary-btn ud-features-cta__btn ud-features-cta__btn--secondary">
            {{ $page->t('Try for Free') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection
