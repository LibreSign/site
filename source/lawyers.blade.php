@extends('_layouts.main')

@section('body')
  @php
    $lawyerChallengeItems = [
      [
        'title' => $page->t('Signature with Full Legal Value'),
        'icon' => $page->baseUrl . 'assets/images/solutions/lawyers-legal-value-icon.png',
        'body' => $page->t('Ensure your documents remain fully valid before the law with signatures that follow strict legal authenticity standards.'),
      ],
      [
        'title' => $page->t('Traceability and Chain of Custody'),
        'icon' => $page->baseUrl . 'assets/images/solutions/lawyers-chain-icon.png',
        'body' => $page->t('Keep a complete and tamper-proof record of every document step, from request to signature, essential for evidence and audits.'),
      ],
      [
        'title' => $page->t('Organization and Access in One Click'),
        'icon' => $page->baseUrl . 'assets/images/solutions/lawyers-one-click-icon.png',
        'body' => $page->t('Centralize your digital documents and provide secure access for you and your clients, from anywhere.'),
      ],
    ];

    $lawyerValueItems = [
      [
        'title' => $page->t('Efficient Workflow Management'),
        'icon' => $page->baseUrl . 'assets/images/solutions/lawyers-efficiency-icon.png',
        'body' => $page->t('Automate document creation and signature flows to accelerate contracts and powers of attorney, boosting productivity in your daily routine.'),
      ],
      [
        'title' => $page->t('Total Legal Security'),
        'icon' => $page->baseUrl . 'assets/images/solutions/lawyers-security-icon.png',
        'body' => $page->t('Rely on advanced encryption and ICP-Brasil standards to guarantee legal validity and confidentiality in every document.'),
      ],
      [
        'title' => $page->t('Reputation and Credibility'),
        'icon' => $page->baseUrl . 'assets/images/solutions/lawyers-reputation-icon.png',
        'body' => $page->t('Impress clients with a modern and secure digital signing experience fully aligned with your firm’s brand and trust standards.'),
      ],
    ];
  @endphp

  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/lawyers-hero.png')",
    'title' => $page->t('Your Firm’s Credibility, the Legal Validity of Every Signature.'),
    'description' => $page->t('Simplify the management of documents, contracts, and powers of attorney with the legal compliance and security your practice requires.'),
    'actions' => [
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Try It Free'),
        'class' => 'ud-main-btn w-100 text-center',
      ],
      [
        'href' => '#lawyers-challenges',
        'label' => $page->t('Explore Security Features'),
        'class' => 'ud-secondary-btn w-100 text-center',
      ],
    ],
  ])

  <div class="ud-law-page">
    <section id="lawyers-challenges" class="ud-law-challenges">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-10">
            <h3 class="ud-home-section__title">{{ $page->t('Put an End to Risk and Document Management Complexity.') }}</h3>
            <p class="ud-home-section__subtitle">
              {{ $page->t('Legal management complexity should never become a liability. Discover solutions that provide security, traceability, and operational speed.') }}
            </p>
          </div>
        </div>

        <div class="row text-center justify-content-evenly gy-5 align-items-stretch">
          @foreach ($lawyerChallengeItems as $item)
            <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up">
              <article class="ud-law-challenge-card">
                <div class="ud-law-challenge-card__icon">
                  <img src="{{ $item['icon'] }}" alt="" />
                </div>
                <h4 class="ud-law-challenge-card__title">{{ $item['title'] }}</h4>
                <p class="ud-law-challenge-card__body">{{ $item['body'] }}</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-law-challenges__actions text-center">
          <a href="#lawyers-value" class="ud-main-btn ud-law-challenges__cta">
            {{ $page->t('Discover Smart Legal Management') }}
          </a>
        </div>
      </div>
    </section>

    <section id="lawyers-value" class="ud-law-value">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-11">
            <h3 class="ud-law-value__title">{{ $page->t('Smart Legal Management.') }}</h3>
            <p class="ud-law-value__subtitle">
              {{ $page->t('Leave bureaucracy behind and focus your time on what matters most: legal strategy and client success.') }}
            </p>
          </div>
        </div>

        <div class="row gy-4 justify-content-center">
          @foreach ($lawyerValueItems as $item)
            <div class="col-xl-4 col-md-6 d-flex">
              <article class="ud-law-value-card">
                <div class="ud-law-value-card__icon">
                  <img src="{{ $item['icon'] }}" alt="" />
                </div>
                <h4 class="ud-law-value-card__title">{{ $item['title'] }}</h4>
                <p class="ud-law-value-card__body">{{ $item['body'] }}</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-law-value__actions">
          <a href="{{ locale_url($page, 'pricing') }}" class="ud-main-btn ud-law-value__btn ud-law-value__btn--primary">
            {{ $page->t('View Plans and Pricing') }}
          </a>
          <a href="{{ locale_url($page, 'contact-us') }}" class="ud-secondary-btn ud-law-value__btn ud-law-value__btn--secondary">
            {{ $page->t('Talk to Our Specialists') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection
