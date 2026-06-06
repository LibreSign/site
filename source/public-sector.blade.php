@extends('_layouts.main')

@section('body')
  {{-- ====== Hero ====== --}}
  <section class="ud-ps-hero">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="ud-ps-hero__content">
            <h1 class="ud-ps-hero__title">
              {{ $page->t('Assinatura digital: eficiência e validade para gestão pública.') }}
            </h1>
            <p class="ud-ps-hero__desc">
              {{ $page->t('Desburocratize processos com tecnologia segura, garantindo transparência e total conformidade jurídica em seu órgão.') }}
            </p>
            <div class="ud-ps-hero__actions">
              <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn ud-ps-hero__primary-btn">
                {{ $page->t('Solicite uma Demonstração') }}
              </a>
              <a href="{{ locale_url($page, 'contact-us') }}" class="ud-secondary-btn">
                {{ $page->t('Ver Cases de Sucesso (Setor Público)') }}
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="ud-ps-hero__illustration">
            <img
              src="{{ $page->baseUrl }}assets/images/solutions/public-sector.png"
              alt="{{ $page->t('Ilustração do setor público') }}"
              class="ud-ps-hero__svg"
            />
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ====== Desafios ====== --}}
  <section class="ud-ps-challenges">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 text-center">
          <div class="ud-section-title mx-auto">
            <h2>{{ $page->t('Desafios do Setor Público que o LibreSign Transforma em Soluções.') }}</h2>
          </div>
          <p class="ud-ps-section__subtitle">
            {{ $page->t('Documentos físicos, processos lentos e a insegurança da gestão manual são dores do passado. Descubra como o LibreSign moderniza o seu órgão.') }}
          </p>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-2">
        <div class="col d-flex">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-shield-2-check" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Segurança e Validade Jurídica') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Garanta a integridade, autenticidade e validade legal de cada documento, com assinaturas digitais conforme a legislação vigente.') }}
            </p>
          </div>
        </div>

        <div class="col d-flex">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-gear-1" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Otimização de Recursos Públicos') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Reduza custos com papel, impressão e logística. Direcione os recursos públicos para o que realmente importa: o cidadão.') }}
            </p>
          </div>
        </div>

        <div class="col d-flex">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-eye" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Transparência e Rastreabilidade Total') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Cada assinatura é um registro auditável. Ofereça total transparência ao cidadão e facilite auditorias internas e externas.') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ====== 3 Passos ====== --}}
  <section class="ud-ps-process">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-10">
          <h2 class="ud-ps-process__title">{{ $page->t('Transforme seus Processos em 3 Passos Simples.') }}</h2>
          <p class="ud-ps-process__subtitle">
            {{ $page->t('Com a nossa plataforma, assinar, gerenciar e arquivar documentos nunca foi tão seguro e descomplicado para o seu órgão.') }}
          </p>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">
        <div class="col d-flex">
          <div class="ud-ps-step-card">
            <h3 class="ud-ps-step-card__title">{{ $page->t('Carregue o Documento') }}</h3>
            <p class="ud-ps-step-card__body">
              {{ $page->t('Deixe o processo de lado. Simplesmente envie o documento para a plataforma, seja por upload ou integração.') }}
            </p>
          </div>
        </div>

        <div class="col d-flex">
          <div class="ud-ps-step-card">
            <h3 class="ud-ps-step-card__title">{{ $page->t('Assine e Envie') }}</h3>
            <p class="ud-ps-step-card__body">
              {{ $page->t('Assine o documento de forma eletrônica e convide outras partes para assinar de forma rápida e segura.') }}
            </p>
          </div>
        </div>

        <div class="col d-flex">
          <div class="ud-ps-step-card">
            <h3 class="ud-ps-step-card__title">{{ $page->t('Valide e Arquive') }}</h3>
            <p class="ud-ps-step-card__body">
              {{ $page->t('Acesse o histórico de assinaturas, valide a autenticidade do documento e armazene-o de forma segura, com total validade jurídica.') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ====== Recursos / CTA ====== --}}
  <section class="ud-ps-resources">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-8">
          <h2 class="ud-ps-resources__title">{{ $page->t('Conheça Nossos Recursos') }}</h2>
          <div class="ud-ps-resources__actions">
            <a href="{{ locale_url($page, 'pricing') }}" class="ud-main-btn">
              {{ $page->t('Ver Planos e Preços') }}
            </a>
            <a href="{{ locale_url($page, 'contact-us') }}" class="ud-secondary-btn">
              {{ $page->t('Fale com Nossos Especialistas') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
