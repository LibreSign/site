---
title: "About LibreSign - Open Source Electronic Signature Software"
description: "Learn the story of LibreSign and LibreCode, a cooperative of open-source specialists dedicated to building free, transparent, and secure digital signature software."
---
@extends('_layouts.main')

@section('body')
  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(45,55,72,.96) 0%, rgba(45,55,72,.9) 33%, rgba(45,55,72,.72) 58%, rgba(45,55,72,.35) 100%), url('{$page->baseUrl}assets/images/about/hero.png')",
    'title' => $page->t('Technology, People, and Open Source Software.'),
    'description' => $page->t('Learn the story of a cooperative of open-source specialists created to bring more freedom, transparency, and security to your digital world.'),
    'actions' => [
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Talk to Our Specialists'),
        'class' => 'btn ud-btn-solid-amber ud-btn-lg w-100 text-center',
      ],
      [
        'href' => locale_url($page, 'pricing'),
        'label' => $page->t('View All Plans'),
        'class' => 'btn ud-btn-ghost w-100 text-center',
      ],
    ],
  ])

  <section class="ud-about-story">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-10">
          <h2 class="ud-about-story__title">{{ $page->t('The Perfect Tool for a World in Transformation.') }}</h2>
        </div>
      </div>

      <div class="row gy-5 align-items-start">
        <div class="col-lg-6">
          <div class="ud-about-story__text">
            <p>
              {{ $page->t('LibreSign is a web application for electronic signatures (e-Sign) developed by LibreCode cooperative. Its story began in early 2020, during a global pandemic, when the need to digitize documents safely and quickly became critical for people and organizations.') }}
            </p>
            <p>
              {{ $page->t('From that urgent context, our mission emerged: to build a web solution that allows contracts and proposals to be signed and managed online with full security and agility, without giving up freedom and control. This mission is deeply connected to our commitment to open source software.') }}
            </p>
            <p>
              {{ $page->t('As an open-source solution, LibreSign gives you the freedom to audit, customize, and scale the platform to your needs. We believe trust is the core of every digital relationship — that is why every signature and workflow is protected with robust technology and complete traceability.') }}
            </p>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="ud-about-timeline">
            <article class="ud-about-timeline__item">
              <div class="ud-about-timeline__badge">01</div>
              <div class="ud-about-timeline__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/legal-validity.svg" alt="{{ $page->t('Document workflow icon') }}">
              </div>
              <div class="ud-about-timeline__content">
                <h3>{{ $page->t('The Beginning: The Era of Physical Documents.') }}</h3>
                <p>{{ $page->t('Before digital transformation, document management meant bureaucracy, in-person signatures, and constant risk of loss.') }}</p>
              </div>
            </article>

            <article class="ud-about-timeline__item">
              <div class="ud-about-timeline__badge">02</div>
              <div class="ud-about-timeline__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/realtime-monitoring.svg" alt="{{ $page->t('Digital transformation icon') }}">
              </div>
              <div class="ud-about-timeline__content">
                <h3>{{ $page->t('The Need for Transformation.') }}</h3>
                <p>{{ $page->t('Starting in 2020, in a context of global urgency, the search for secure and agile remote document workflows became unavoidable.') }}</p>
              </div>
            </article>

            <article class="ud-about-timeline__item">
              <div class="ud-about-timeline__badge">03</div>
              <div class="ud-about-timeline__icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/features/integration-flexibility.svg" alt="{{ $page->t('Future workflow icon') }}">
              </div>
              <div class="ud-about-timeline__content">
                <h3>{{ $page->t('The Future: Complete Digital Management.') }}</h3>
                <p>{{ $page->t('From this scenario, LibreSign was born — combining open-source freedom with digital-signature security to transform end-to-end management.') }}</p>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-about-values">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-10">
          <h2 class="ud-about-values__title">{{ $page->t('What Makes Us Unique: Cooperative Strength and Open-Source Freedom.') }}</h2>
        </div>
      </div>

      <div class="row gy-5 justify-content-center align-items-stretch">
        <div class="col-lg-6 d-flex">
          <article class="ud-card">
            <div class="ud-card__icon">
              <img src="{{ $page->baseUrl }}assets/images/about/about-coop.png" alt="{{ $page->t('Cooperative model icon') }}">
            </div>
            <div class="ud-card__header">
              <h3 class="ud-card__title">{{ $page->t('Why a cooperative?') }}</h3>
            </div>
            <div class="ud-card__body">
              <p>
                {{ $page->t('We are a digital cooperative of open-source specialists with transparent and democratic decision-making. Our members are partners who grow together with the business, aligned around one goal: delivering the best solution for you.') }}
              </p>
            </div>
          </article>
        </div>
        <div class="col-lg-6 d-flex">
          <article class="ud-card">
            <div class="ud-card__icon">
              <img src="{{ $page->baseUrl }}assets/images/about/about-gnu.png" alt="{{ $page->t('Open source icon') }}">
            </div>
            <div class="ud-card__header">
              <h3 class="ud-card__title">{{ $page->t('Why open-source software?') }}</h3>
            </div>
            <div class="ud-card__body">
              <p>
                {{ $page->t('Open-source software like LibreSign is built collaboratively. Specialists continuously test and improve the code, resulting in a fully auditable platform where transparency becomes your guarantee of security and innovation.') }}
              </p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-about-team">
    <div class="container">
      <div class="row align-items-center gy-5">
        <div class="col-lg-6">
          <div class="ud-about-team__media">
            <img src="{{ $page->baseUrl }}assets/images/about/about-team-photo.png" alt="{{ $page->t('LibreCode team') }}">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="ud-about-team__content">
            <h2>{{ $page->t('The Team That Builds Trust.') }}</h2>
            <p>{{ $page->t('Meet the people behind the technology. We are specialists passionate about creating solutions that unite security, freedom, and human impact.') }}</p>
            <blockquote class="ud-about-team__quote">
              <p>{{ $page->t('It’s not only about using technology, but about how it can make life more connected and more human. That is what moves us.') }}</p>
              <footer>
                <strong>{{ $page->t('Daiane Alves') }}</strong>
                <span>{{ $page->t('President of LibreCode') }}</span>
              </footer>
            </blockquote>
            <a href="{{ locale_url($page, 'team') }}" class="btn ud-btn-solid-brand ud-about-team__btn">{{ $page->t('Our Complete Story') }}</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-about-cta">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-9">
          <h2>{{ $page->t('A Story of Trust, Built for the Future.') }}</h2>
          <p>{{ $page->t('Join a community that values collaboration, security, and innovation. Let’s build a more transparent digital future together.') }}</p>
        </div>
      </div>
      <div class="ud-about-cta__actions">
        <a href="{{ locale_url($page, 'pricing') }}" class="btn ud-btn-solid-warm">{{ $page->t('Explore Our Products') }}</a>
        <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-ghost">{{ $page->t('Talk to a Specialist') }}</a>
      </div>
    </div>
  </section>
@endsection
