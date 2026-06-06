@extends('_layouts.main')

@section('body')
  @php
    $companyBenefitItems = [
      [
        'title' => $page->t('Agilidade e Produtividade'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/company-agility-icon.svg',
        'body' => $page->t('Assine contratos, propostas e documentos em minutos, de qualquer lugar, acelerando suas vendas e operações.'),
      ],
      [
        'title' => $page->t('Redução de Custos'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/company-cost-icon.svg',
        'body' => $page->t('Elimine gastos desnecessários com impressora, correios, motoboy e arquivamento físico. Seu departamento financeiro agradece.'),
      ],
      [
        'title' => $page->t('Profissionalismo e Credibilidade'),
        'icon'  => $page->baseUrl . 'assets/images/solutions/company-credibility-icon.svg',
        'body' => $page->t('Impressione seus clientes e parceiros com um processo de assinatura moderno, ágil, seguro, transparente e totalmente digital.'),
      ],
    ];

    $companyTestimonials = [
      [
        'name' => $page->t('Leonardo Machado'),
        'role' => $page->t('CEO da Garbo Marketing'),
        'quote' => $page->t('O LibreSign é uma solução moderna, segura e prática que otimiza a assinatura de contratos e garante transparência e rastreabilidade nos processos.'),
      ],
      [
        'name' => $page->t('Leonardo Machado'),
        'role' => $page->t('CEO da Garbo Marketing'),
        'quote' => $page->t('O LibreSign é uma solução moderna, segura e prática que otimiza a assinatura de contratos e garante transparência e rastreabilidade nos processos.'),
      ],
      [
        'name' => $page->t('Leonardo Machado'),
        'role' => $page->t('CEO da Garbo Marketing'),
        'quote' => $page->t('O LibreSign é uma solução moderna, segura e prática que otimiza a assinatura de contratos e garante transparência e rastreabilidade nos processos.'),
      ],
    ];
  @endphp

  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/company-solutions-background.png')",
    'title' => $page->t('Assinatura digital que impulsiona o crescimento da sua empresa.'),
    'description' => $page->t('Libere sua empresa da burocracia do papel. Foco no crescimento, agilidade e profissionalismo da sua gestão.'),
    'actions' => [
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Experimente Grátis Agora'),
        'class' => 'ud-main-btn w-100 text-center',
      ],
      [
        'href' => '#company-benefits',
        'label' => $page->t('Entenda como funciona'),
        'class' => 'ud-secondary-btn w-100 text-center',
      ],
    ],
  ])

  <div class="ud-cs-page">
    <section id="company-benefits" class="ud-cs-benefits">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-10">
            <h3 class="ud-home-section__title">{{ $page->t('Deixe para Trás o Papel e Abrace a Agilidade Digital.') }}</h3>
            <p class="ud-home-section__subtitle">
              {{ $page->t('Transforme a papelada em produtividade. Descubra como o LibreSign otimiza seu tempo e reduz custos para o seu negócio.') }}
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
            {{ $page->t('Conheça a Plataforma') }}
          </a>
        </div>
      </div>
    </section>

    <section id="company-testimonials" class="ud-cs-testimonials">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-11">
            <h3 class="ud-cs-testimonials__title">{{ $page->t('A Transformação Digital vista pelos Nossos Clientes.') }}</h3>
            <p class="ud-cs-testimonials__subtitle">
              {{ $page->t('Conheça as histórias reais de empresas que, com o LibreSign, simplificaram processos, garantiram segurança e aceleraram seus resultados.') }}
            </p>
          </div>
        </div>

        <div class="row gy-4 justify-content-center">
          @foreach ($companyTestimonials as $item)
            <div class="col-xl-4 col-md-6 d-flex">
              <article class="ud-cs-testimonial-card">
                <div class="ud-cs-testimonial-card__avatar" aria-hidden="true">
                  <i class="lni lni-user"></i>
                </div>
                <h4 class="ud-cs-testimonial-card__name">{{ $item['name'] }}</h4>
                <p class="ud-cs-testimonial-card__role">{{ $item['role'] }}</p>
                <p class="ud-cs-testimonial-card__quote">“{{ $item['quote'] }}”</p>
              </article>
            </div>
          @endforeach
        </div>

        <div class="ud-cs-testimonials__actions">
          <a href="{{ locale_url($page, 'pricing') }}" class="ud-main-btn ud-cs-testimonials__btn ud-cs-testimonials__btn--primary">
            {{ $page->t('Ver Planos e Preços') }}
          </a>
          <a href="{{ locale_url($page, 'contact-us') }}" class="ud-secondary-btn ud-cs-testimonials__btn ud-cs-testimonials__btn--secondary">
            {{ $page->t('Fale com Nossos Especialistas') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection