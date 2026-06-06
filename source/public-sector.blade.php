@extends('_layouts.main')

@section('body')
  @php
    $publicSectorChallengeItems = [
      [
        'title' => $page->t('Segurança e Validade Jurídica'),
        'icon' => $page->baseUrl . 'assets/images/icon/features/legal-validity.svg',
        'body' => $page->t('Garanta a integridade, autenticidade e validade legal de cada documento, com assinaturas digitais conforme a legislação vigente.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Otimização de Recursos Públicos'),
        'icon' => $page->baseUrl . 'assets/images/icon/features/digital-signature.svg',
        'body' => $page->t('Reduza custos com papel, impressão e logística. Direcione os recursos públicos para o que realmente importa: o cidadão.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Transparência e Rastreabilidade Total'),
        'icon' => $page->baseUrl . 'assets/images/icon/features/realtime-monitoring.svg',
        'body' => $page->t('Cada assinatura é um registro auditável. Ofereça total transparência ao cidadão e facilite auditorias internas e externas.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
    ];

    $publicSectorProcessItems = [
      [
        'title' => $page->t('Carregue o Documento'),
        'icon' => $page->baseUrl . 'assets/images/icon/features/digital-signature.svg',
        'body' => $page->t('Envie o documento para a plataforma, seja por upload ou integração, e inicie o fluxo sem burocracia.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Assine e Envie'),
        'icon' => $page->baseUrl . 'assets/images/icon/features/advanced-security.svg',
        'body' => $page->t('Assine eletronicamente e convide outras partes para concluir o processo com rapidez e segurança.'),
        'colClass' => 'col-lg-4 col-md-6 d-flex',
      ],
      [
        'title' => $page->t('Valide e Arquive'),
        'icon' => $page->baseUrl . 'assets/images/icon/features/qrcode-validation.svg',
        'body' => $page->t('Valide a autenticidade, acompanhe o histórico de assinaturas e arquive com total validade jurídica.'),
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
      'title' => $page->t('Desafios do setor público que o LibreSign transforma em soluções.'),
      'subtitle' => $page->t('Documentos físicos, processos lentos e insegurança operacional dão lugar a fluxos digitais confiáveis, auditáveis e eficientes.'),
      'items' => $publicSectorChallengeItems,
      'sectionActions' => [
        [
          'href' => '#public-sector-resources',
          'label' => $page->t('Conheça Nossos Recursos'),
          'class' => 'ud-main-btn ud-ps-section__cta',
        ],
      ],
    ])

    @include('_partials.home.card-grid-section', [
      'sectionClass' => 'ud-home-benefits ud-ps-section ud-ps-section--process',
      'title' => $page->t('Transforme seus processos em 3 passos simples.'),
      'subtitle' => $page->t('Com a nossa plataforma, assinar, gerenciar e arquivar documentos nunca foi tão seguro e descomplicado para o seu órgão.'),
      'items' => $publicSectorProcessItems,
      'rowClass' => 'row text-center justify-content-center gy-5 align-items-stretch',
    ])

    @include('_partials.home.cta-section', [
      'sectionClass' => 'ud-home-cta ud-ps-cta',
      'sectionId' => 'public-sector-resources',
      'title' => $page->t('Conheça nossos recursos para modernizar a gestão pública.'),
      'description' => $page->t('Leve mais eficiência, validade jurídica e transparência para os fluxos documentais do seu órgão com LibreSign.'),
      'actions' => [
        [
          'href' => locale_url($page, 'contact-us'),
          'label' => $page->t('Fale com nossos especialistas'),
          'class' => 'ud-home-cta__btn ud-home-cta__btn--primary',
        ],
        [
          'href' => locale_url($page, 'register'),
          'label' => $page->t('Experimente gratuitamente'),
          'class' => 'ud-home-cta__btn ud-home-cta__btn--secondary',
        ],
      ],
    ])
  </div>

@endsection
