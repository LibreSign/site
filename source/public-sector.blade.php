@extends('_layouts.main')

@section('body')
  @php
    $publicSectorChallengeItems = [
      [
        'title' => $page->t('Security and Legal Validity'),
        'icon' => $page->baseUrl . 'assets/images/solutions/challenge-legal-icon.svg',
        'body' => $page->t('Ensure the integrity, authenticity, and legal validity of every document with digital signatures compliant with current regulations.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Optimization of Public Resources'),
        'icon' => $page->baseUrl . 'assets/images/solutions/challenge-resources-icon.svg',
        'body' => $page->t('Reduce costs with paper, printing, and logistics. Redirect public resources to what truly matters: citizens.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Full Transparency and Traceability'),
        'icon' => $page->baseUrl . 'assets/images/solutions/challenge-transparency-icon.svg',
        'body' => $page->t('Every signature is an auditable record. Provide full transparency to citizens and simplify internal and external audits.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
    ];

    $publicSectorProcessItems = [
      [
        'title' => $page->t('Upload the Document'),
        'icon' => $page->baseUrl . 'assets/images/solutions/process-upload-icon.png',
        'body' => $page->t('Leave bureaucracy behind. Simply send the document to the platform, either by upload or integration.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Sign and Send'),
        'icon' => $page->baseUrl . 'assets/images/solutions/process-sign-icon.png',
        'body' => $page->t('Sign the document electronically and invite other parties to sign quickly and securely.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Validate and Archive'),
        'icon' => $page->baseUrl . 'assets/images/solutions/process-validate-icon.png',
        'body' => $page->t('Access signature history, validate document authenticity, and store it securely with full legal validity.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
    ];
  @endphp

  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/public-sector-background.png')",
    'title' => $page->t('Digital signatures: efficiency and legal validity for public administration.'),
    'description' => $page->t('Streamline workflows with secure technology, ensuring transparency, traceability, and legal compliance for your organization.'),
    'actions' => [
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Request a demo'),
        'class' => 'btn ud-btn-hero w-100 text-center',
      ],
      [
        'href' => locale_url($page, 'pricing'),
        'label' => $page->t('View plans and pricing'),
        'class' => 'btn ud-btn-ghost w-100 text-center',
      ],
    ],
  ])

  <div class="ud-ps-page">
    @include('_partials.home.card-grid-section', [
      'sectionClass' => 'ud-home-challenges ud-ps-section ud-page-section',
      'cardClass'    => 'ud-card--outlined',
      'title' => $page->t('Public Sector Challenges LibreSign Turns into Solutions.'),
      'subtitle' => $page->t('Physical documents, slow workflows, and the insecurity of manual management are problems of the past. Discover how LibreSign modernizes your organization.'),
      'items' => $publicSectorChallengeItems,
      'sectionActions' => [
        [
          'href' => '#public-sector-process',
          'label' => $page->t('Explore Our Features'),
          'class' => 'btn ud-btn-primary',
        ],
      ],
    ])

    <section id="public-sector-process" class="ud-ps-process">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-10">
            <h3 class="ud-ps-process__title">{{ $page->t('Transform Your Workflows in 3 Simple Steps.') }}</h3>
            <p class="ud-ps-process__subtitle">
              {{ $page->t('With our platform, signing, managing, and archiving documents has never been safer or simpler for your organization.') }}
            </p>
          </div>
        </div>

        <div class="row justify-content-center text-center gy-5 ud-ps-process__steps">
          @foreach ($publicSectorProcessItems as $item)
            <div class="col-lg-4 col-md-6 d-flex justify-content-center">
              <article class="ud-ps-process-step">
                <div class="ud-ps-process-step__icon">
                  <img src="{{ $item['icon'] }}" alt="" />
                </div>
                <h4 class="ud-ps-process-step__title">{{ $item['title'] }}</h4>
                <p class="ud-ps-process-step__body">{{ $item['body'] }}</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-ps-process__actions">
          <a href="{{ locale_url($page, 'pricing') }}" class="btn ud-btn-accent">
            {{ $page->t('View Plans and Pricing') }}
          </a>
          <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-ghost">
            {{ $page->t('Talk to Our Specialists') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection
