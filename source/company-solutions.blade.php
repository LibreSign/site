@extends('_layouts.main')

@section('body')
  @php
    $companyBenefitItems = [
      [
        'title' => $page->t('Agility and Productivity'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/company-agility-icon.svg',
        'body' => $page->t('Sign contracts, proposals, and documents in minutes from anywhere, accelerating your sales and operations.'),
      ],
      [
        'title' => $page->t('Cost Reduction'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/company-cost-icon.svg',
        'body' => $page->t('Eliminate unnecessary spending on printers, mail, couriers, and physical filing. Your finance team will thank you.'),
      ],
      [
        'title' => $page->t('Professionalism and Credibility'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/company-credibility-icon.svg',
        'body' => $page->t('Impress clients and partners with a modern, agile, secure, transparent, and fully digital signing process.'),
      ],
    ];

    $companyTestimonials = collect($page->testimonials ?? [])->filter(fn ($item) => ($item->section ?? null) === 'company')->values();
  @endphp

  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/company-solutions-background.png')",
    'title' => $page->t('Digital signatures that drive your company’s growth.'),
    'description' => $page->t('Free your company from paperwork. Focus on growth, agility, and professionalism in your operations.'),
    'actions' => [
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Try It Free Now'),
        'class' => 'ud-main-btn w-100 text-center',
      ],
      [
        'href' => '#company-benefits',
        'label' => $page->t('See How It Works'),
        'class' => 'ud-secondary-btn w-100 text-center',
      ],
    ],
  ])

  <div class="ud-cs-page">
    <section id="company-benefits" class="ud-cs-benefits">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-10">
            <h3 class="ud-home-section__title">{{ $page->t('Leave Paper Behind and Embrace Digital Agility.') }}</h3>
            <p class="ud-home-section__subtitle">
              {{ $page->t('Turn paperwork into productivity. Discover how LibreSign optimizes your time and reduces costs for your business.') }}
            </p>
          </div>
        </div>

        <div class="row text-center justify-content-evenly gy-5 align-items-stretch">
          @foreach ($companyBenefitItems as $item)
            <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up">
              <article class="ud-cs-benefit-card">
                <div class="ud-cs-benefit-card__icon">
                  <img src="{{ $item['icon'] }}" alt="" />
                </div>
                <h4 class="ud-cs-benefit-card__title">{{ $item['title'] }}</h4>
                <p class="ud-cs-benefit-card__body">{{ $item['body'] }}</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-cs-benefits__actions text-center">
          <a href="#company-testimonials" class="ud-main-btn ud-cs-benefits__cta">
            {{ $page->t('Discover the Platform') }}
          </a>
        </div>
      </div>
    </section>

    <section id="company-testimonials" class="ud-cs-testimonials">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-11">
            <h3 class="ud-cs-testimonials__title">{{ $page->t('Digital Transformation Through Our Customers’ Eyes.') }}</h3>
            <p class="ud-cs-testimonials__subtitle">
              {{ $page->t('Read real stories from companies that, with LibreSign, simplified processes, strengthened security, and accelerated results.') }}
            </p>
          </div>
        </div>

        <div class="row gy-4 justify-content-center">
          @foreach ($companyTestimonials as $item)
            <div class="col-xl-4 col-md-6 d-flex">
              <article class="ud-cs-testimonial-card">
                <div class="ud-cs-testimonial-card__avatar">
                  <img src="{{ $page->baseUrl }}{{ ltrim($item['photo'], '/') }}" alt="{{ $item['name'] }}" />
                </div>
                <h4 class="ud-cs-testimonial-card__name">{{ $page->t($item['name']) }}</h4>
                <p class="ud-cs-testimonial-card__role">{{ $page->t($item['role']) }}</p>
                <p class="ud-cs-testimonial-card__quote">“{{ $page->t($item['quote']) }}”</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-cs-testimonials__actions">
          <a href="{{ locale_url($page, 'pricing') }}" class="ud-main-btn ud-cs-testimonials__btn ud-cs-testimonials__btn--primary">
            {{ $page->t('View Plans and Pricing') }}
          </a>
          <a href="{{ locale_url($page, 'contact-us') }}" class="ud-secondary-btn ud-cs-testimonials__btn ud-cs-testimonials__btn--secondary">
            {{ $page->t('Talk to Our Specialists') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection
