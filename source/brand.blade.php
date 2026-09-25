---
title: "LibreSign Brand and Pronunciation"
description: "Official guidance for the LibreSign name, pronunciation, and visual identity."
---
@extends('_layouts.main')

@section('body')
  <section class="ud-page-banner ud-brand-banner">
    <div class="container">
      <div class="ud-banner-content">
        <p class="ud-brand-banner__eyebrow">{{ $page->t('LibreSign brand') }}</p>
        <h1>{{ $page->t('Brand and pronunciation') }}</h1>
        <p>{{ $page->t('How to write, pronounce, and use the LibreSign identity correctly.') }}</p>
      </div>
    </div>
  </section>

  <section class="ud-brand-basics">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-6 d-flex">
          <article class="ud-brand-card w-100">
            <p class="ud-brand-card__label">{{ $page->t('Official name') }}</p>
            <h2>LibreSign</h2>
            <p>{{ $page->t('Always write LibreSign with an uppercase L and S, with no space between Libre and Sign.') }}</p>
            <p class="ud-brand-card__note">{{ $page->t('Avoid: Libresign, Libre Sign, libreSign.') }}</p>
          </article>
        </div>

        <div class="col-lg-6 d-flex">
          <article class="ud-brand-card w-100">
            <p class="ud-brand-card__label">{{ $page->t('Pronunciation') }}</p>
            <h2><span aria-label="{{ $page->t('International Phonetic Alphabet transcription') }}">/ˈli.bɾe saɪn/</span></h2>
            <p><strong>Libre</strong>: /ˈli.bɾe/. {{ $page->t('It begins with an ee sound, not “lye”.') }}</p>
            <p><strong>Sign</strong>: {{ $page->t('Use the English pronunciation.') }}</p>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-brand-meaning">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-9 text-center">
          <p class="ud-brand-section-label">{{ $page->t('What the name stands for') }}</p>
          <h2>{{ $page->t('Why “Libre” matters') }}</h2>
          <p>{{ $page->t('Libre means freedom. LibreSign gives organizations practical control over signing infrastructure, documents and data, integration, operation, and long-term maintenance.') }}</p>
          <p>{{ $page->t('That freedom supports self-hosting, inspectable software, interoperability, adaptability, and continuity without dependence on a single proprietary signing service.') }}</p>
          <div class="ud-brand-promise">
            <span>{{ $page->t('Brand promise') }}</span>
            <strong>{{ $page->t('Freedom and control for electronic signing.') }}</strong>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-brand-assets" id="assets">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-5">
          <div class="ud-brand-assets__preview">
            <img
              src="{{ $page->baseUrl }}assets/images/logo/logo.svg"
              alt="{{ $page->t('Official LibreSign logo') }}"
              width="369"
              height="162"
            >
          </div>
        </div>

        <div class="col-lg-7">
          <div class="ud-brand-assets__content">
            <p class="ud-brand-section-label">{{ $page->t('Official files') }}</p>
            <h2>{{ $page->t('Use the canonical LibreSign assets') }}</h2>
            <p>{{ $page->t('Use the official files from the public brand repository. Preserve the logo proportions, clear space, and visual integrity. Do not recreate the logo from screenshots or old exports.') }}</p>

            <div class="ud-brand-assets__actions">
              <a href="https://github.com/LibreSign/brand/releases/download/latest/libresign-logo.svg" class="btn ud-btn-solid-brand">{{ $page->t('Logo SVG') }}</a>
              <a href="https://github.com/LibreSign/brand/releases/download/latest/libresign-logo.png" class="btn ud-btn-outline-brand">{{ $page->t('Logo PNG') }}</a>
              <a href="https://github.com/LibreSign/brand/releases/download/latest/libresign-brand-manual.pdf" class="btn ud-btn-outline-brand">{{ $page->t('Brand manual PDF') }}</a>
            </div>

            <div class="ud-brand-assets__meta">
              <p><strong>{{ $page->t('Digital system:') }}</strong> {{ $page->t('Primary teal #184c4e · Montserrat typeface.') }}</p>
              <p>{{ $page->t('Interface colors are not logo colors. Always use the official artwork.') }}</p>
            </div>

            <a href="https://github.com/LibreSign/brand" class="ud-brand-source-link" target="_blank" rel="noopener noreferrer">
              {{ $page->t('View the canonical brand source on GitHub') }} →
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
