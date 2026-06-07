@extends('_layouts.main')

@section('body')
  @php
    $cooperativeBenefitItems = [
      [
        'title' => $page->t('Transparent Processes'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/cooperative-transparency-icon.png',
        'body'  => $page->t('The security and traceability of digital signatures strengthen member trust in every decision.'),
      ],
      [
        'title' => $page->t('Unified and Efficient Management'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/cooperative-efficiency-icon.png',
        'body'  => $page->t('Centralize document management and accelerate approvals for proposals, contracts, and meeting minutes with digital signatures.'),
      ],
      [
        'title' => $page->t('Protection for Your Data and Members'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/cooperative-protection-icon.png',
        'body'  => $page->t('Ensure document integrity and keep member information protected with advanced encryption technology.'),
      ],
    ];

    $cooperativeHighlights = [
      $page->t('Built by people who live cooperativism: our origin is your guarantee that we understand your needs and value trust-based relationships.'),
      $page->t('Unquestionable security and auditability: every document is protected and traceable, delivering the reliability your members expect.'),
      $page->t('Total control and autonomy: the platform is designed to give your cooperative democratic control over data and workflows, without lock-in.'),
      $page->t('Transparency at every stage: we believe trust is built with clarity, from signature request to final archive.'),
    ];
  @endphp

  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/cooperative-hero.png')",
    'title' => $page->t('Digital Signatures with Cooperative DNA for Your Organization.'),
    'description' => $page->t('From assembly minutes to daily operations, solve your cooperative’s challenges with secure, transparent, and people-centered digital workflows.'),
    'actions' => [
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Request a Demo'),
        'class' => 'btn ud-btn-solid-amber ud-btn-lg w-100 text-center',
      ],
      [
        'href' => '#cooperative-benefits',
        'label' => $page->t('Explore the Platform'),
        'class' => 'btn ud-btn-ghost w-100 text-center',
      ],
    ],
  ])

  <div class="ud-coop-page">
    @include('_partials.home.card-grid-section', [
      'sectionId'    => 'cooperative-benefits',
      'sectionClass' => 'ud-coop-benefits ud-page-section',
      'cardClass'    => 'ud-card--outlined',
      'title'    => $page->t('From Governance to Operations: Turn Cooperative Challenges into Results.'),
      'subtitle' => $page->t('Your cooperative faces unique challenges. See how LibreSign simplifies processes and strengthens governance with security and transparency.'),
      'items'    => $cooperativeBenefitItems,
      'sectionActions' => [[
        'href'  => '#cooperative-dna',
        'label' => $page->t('Explore the Cooperative Plan'),
        'class' => 'btn ud-btn-solid-brand',
      ]],
    ])

    <section id="cooperative-dna" class="ud-coop-dna">
      <div class="container">
        <div class="row g-5 align-items-center">
          <div class="col-lg-5">
            <div class="ud-coop-dna__media">
              <img src="{{ $page->baseUrl }}assets/images/solutions/cooperative-team-photo.png" alt="{{ $page->t('LibreCode cooperative team') }}" />
            </div>
          </div>

          <div class="col-lg-7">
            <h3 class="ud-coop-dna__title">{{ $page->t('LibreSign: Digital Signatures with Cooperative DNA.') }}</h3>
            <p class="ud-coop-dna__subtitle">
              {{ $page->t('Developed by LibreCode cooperative to strengthen trust, governance, and collaboration in your cooperative.') }}
            </p>

            <ul class="ud-coop-dna__list">
              @foreach ($cooperativeHighlights as $highlight)
                <li>{{ $highlight }}</li>
              @endforeach
            </ul>

            <p class="ud-coop-dna__closing">
              {{ $page->t('Choose a partner that shares your values. Choose technology that is not only functional, but genuinely yours.') }}
            </p>

            <div class="ud-coop-dna__actions">
              <a href="{{ locale_url($page, 'pricing') }}" class="btn ud-btn-solid-warm">
                {{ $page->t('View Plans and Pricing') }}
              </a>
              <a href="{{ locale_url($page, 'about') }}" class="btn ud-btn-ghost">
                {{ $page->t('Learn LibreCode\'s Story') }}
              </a>
              <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-ghost">
                {{ $page->t('Talk to Our Specialists') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
