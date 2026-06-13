---
title: "LibreSign Features - Secure Open Source Digital Signatures"
description: "Explore LibreSign's core features: digital signatures, document management, multi-signer workflows, API integrations, and more — all on your own self-hosted Nextcloud."
---
@extends('_layouts.main')

@section('body')
  @include('_partials.home.hero-section', [
    'backgroundImage' => "linear-gradient(90deg, rgba(18,60,64,.96) 0%, rgba(24,76,78,.9) 33%, rgba(24,76,78,.58) 58%, rgba(0,163,190,.18) 100%), url('{$page->baseUrl}assets/images/solutions/features-hero.png')",
    'title' => $page->t('Innovation and Security on a Single Platform.'),
    'description' => $page->t('Explore the capabilities that transform digital document management and elevate security and efficiency across your organization.'),
    'actions' => [
      [
        'href' => '#feature-highlights',
        'label' => $page->t('Explore All Features'),
        'class' => 'btn ud-btn-solid-amber ud-btn-lg w-100 text-center',
      ],
      [
        'href' => locale_url($page, 'contact-us'),
        'label' => $page->t('Talk to Our Specialists'),
        'class' => 'btn ud-btn-ghost w-100 text-center',
      ],
    ],
  ])

  <div class="ud-features-page">
    @include('_partials.post-list', [
      'sectionId'    => 'feature-highlights',
      'sectionClass' => 'ud-features-highlights ud-page-section',
      'title'        => $page->t('Core Features That Power Your Business.'),
      'subtitle'     => $page->t('LibreSign combines agility, security, and flexibility through capabilities that adapt to your organization\'s specific needs.'),
      'format'       => 'feature',
      'category'     => 'featured',
      'cardModifier' => 'ud-card--outlined',
      'rowClass'     => 'row text-center gy-5 align-items-stretch',
      'colClass'     => 'col-lg-6 d-flex',
    ])

    <section class="ud-features-cta">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-xl-9">
            <h2 class="ud-features-cta__title">{{ $page->t('Ready to Transform Your Operations?') }}</h2>
            <p class="ud-features-cta__subtitle">
              {{ $page->t('Talk to our specialists or try LibreSign and raise your company’s security and efficiency standards.') }}
            </p>
          </div>
        </div>

        <div class="ud-features-cta__actions">
          <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-solid-warm">
            {{ $page->t('Talk to a Specialist') }}
          </a>
          <a href="{{ locale_url($page, 'register') }}" class="btn ud-btn-ghost">
            {{ $page->t('Try for Free') }}
          </a>
        </div>
      </div>
    </section>
  </div>

@endsection
