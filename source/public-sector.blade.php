@extends('_layouts.main')

@section('body')
  @php
    $publicSectorChallengeItems = [
      [
        'title' => $page->t('Segurança e Validade Jurídica'),
        'icon' => $page->baseUrl . 'assets/images/solutions/challenge-legal-icon.svg',
        'body' => $page->t('Garanta a integridade, autenticidade e validade legal de cada documento, com assinaturas digitais conforme a legislação vigente.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Otimização de Recursos Públicos'),
        'icon' => $page->baseUrl . 'assets/images/solutions/challenge-resources-icon.svg',
        'body' => $page->t('Reduza custos com papel, impressão e logística. Direcione os recursos públicos para o que realmente importa: o cidadão.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Transparência e Rastreabilidade Total'),
        'icon' => $page->baseUrl . 'assets/images/solutions/challenge-transparency-icon.svg',
        'body' => $page->t('Cada assinatura é um registro auditável. Ofereça total transparência ao cidadão e facilite auditorias internas e externas.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
    ];

    $publicSectorProcessItems = [
      [
        'title' => $page->t('Carregue o Documento'),
        'icon' => $page->baseUrl . 'assets/images/solutions/process-upload-icon.png',
        'body' => $page->t('Deixe o processo de lado. Simplesmente envie o documento para a plataforma, seja por upload ou integração.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Assine e Envie'),
        'icon' => $page->baseUrl . 'assets/images/solutions/process-sign-icon.png',
        'body' => $page->t('Assine o documento de forma eletrônica e convide outras partes para assinar de forma rápida e segura.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Valide e Arquive'),
        'icon' => $page->baseUrl . 'assets/images/solutions/process-validate-icon.png',
        'body' => $page->t('Acesse o histórico de assinaturas, valide a autentcidade do documento e armazene-o de forma segura, com total validade jurídica.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
    ];
  @endphp

  @include('_partials.home.hero-section', [
    'sectionClass' => 'ud-hero ud-hero--public-sector',
    'contentWrapperClass' => 'ud-hero-content ud-hero-content--public-sector wow fadeInUp',
    'title' => $page->t('Assinatura digital: eficiência e validade para a gestão pública.'),
    'description' => $page->t('Desburocratize processos com tecnologia segura, garantindo transparência, rastreabilidade e conformidade jurídica para o seu órgão.'),
    'actions' => [
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Solicite uma demonstração'),
        'class' => 'ud-main-btn w-100 text-center',
      ],
      [
        'href' => locale_url($page, 'pricing'),
        'label' => $page->t('Ver planos e preços'),
        'class' => 'ud-secondary-btn w-100 text-center',
      ],
    ],
  ])

  <div class="ud-ps-page">
    @include('_partials.home.card-grid-section', [
      'sectionClass' => 'ud-home-challenges ud-ps-section',
      'title' => $page->t('Desafios do Setor Público que o LibreSign Transforma em Soluções.'),
      'subtitle' => $page->t('Documentos físicos, processos lentos e a insegurança da gestão manual são dores do passado. Descubra como o LibreSign moderniza o seu órgão.'),
      'items' => $publicSectorChallengeItems,
      'sectionActions' => [
        [
          'href' => '#public-sector-process',
          'label' => $page->t('Conheça Nossos Recursos'),
          'class' => 'ud-main-btn ud-ps-section__cta',
        ],
      ],
    ])

    <section id="public-sector-process" class="ud-ps-process">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-10">
            <h3 class="ud-ps-process__title">{{ $page->t('Transforme seus Processos em 3 Passos Simples.') }}</h3>
            <p class="ud-ps-process__subtitle">
              {{ $page->t('Com a nossa plataforma, assinar, gerenciar e arquivar documentos nunca foi tão seguro e descomplicado para o seu órgão.') }}
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
          <a href="{{ locale_url($page, 'pricing') }}" class="ud-main-btn ud-ps-process__btn ud-ps-process__btn--primary">
            {{ $page->t('Ver Planos e Preços') }}
          </a>
          <a href="{{ locale_url($page, 'contact-us') }}" class="ud-secondary-btn ud-ps-process__btn ud-ps-process__btn--secondary">
            {{ $page->t('Fale com Nossos Especialistas') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection
