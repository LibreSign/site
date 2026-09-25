---
title: "LibreSign Brand and Pronunciation"
description: "Official guidance for the LibreSign name, pronunciation, and visual identity."
---
@extends('_layouts.main')

@section('body')
  @include('_partials.home.hero-section', [
    'title' => $page->t('LibreSign brand and pronunciation'),
    'description' => $page->t('The official reference for how to write, pronounce, and identify LibreSign.'),
    'actions' => [],
  ])

  <section class="ud-about-story">
    <div class="container">
      <div class="row gy-5 align-items-start">
        <div class="col-lg-6">
          <div class="ud-about-story__text">
            <h2>{{ $page->t('The name') }}</h2>
            <p>{{ $page->t('Always write LibreSign with an uppercase L and S, with no space between Libre and Sign.') }}</p>
            <p>{{ $page->t('Avoid spellings such as Libresign, Libre Sign, or libreSign.') }}</p>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="ud-about-story__text">
            <h2>{{ $page->t('Pronunciation') }}</h2>
            <p><strong>Libre</strong>: <span aria-label="{{ $page->t('International Phonetic Alphabet transcription') }}">/ˈli.bɾe/</span>. {{ $page->t('It begins with an ee sound, not “lye” as in “laibre”.') }}</p>
            <p><strong>LibreSign</strong>: <span aria-label="{{ $page->t('International Phonetic Alphabet transcription') }}">/ˈli.bɾe saɪn/</span>. {{ $page->t('Sign keeps its English pronunciation.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-about-values">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-10">
          <h2 class="ud-about-values__title">{{ $page->t('Why “Libre” matters') }}</h2>
          <p>{{ $page->t('Libre means freedom. With LibreSign, that means the freedom to run your own signing infrastructure, keep control of documents and data, inspect and adapt the software, integrate it with your environment, and avoid being locked into a single proprietary service.') }}</p>
          <p>{{ $page->t('For organizations, that freedom supports data sovereignty, interoperability, continuity, and the ability to choose how and by whom the solution is operated and maintained.') }}</p>
          <p><strong>{{ $page->t('Brand promise:') }}</strong> {{ $page->t('Freedom and control for electronic signing.') }}</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-about-team" id="assets">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="ud-about-team__content">
            <h2>{{ $page->t('Official LibreSign assets') }}</h2>
            <p>{{ $page->t('Use official, versioned assets and preserve their proportions and visual integrity.') }} {{ $page->t('The canonical source for LibreSign brand rules and assets is versioned in the public brand repository.') }}</p>
            <p>
              <a href="https://github.com/LibreSign/brand/releases/download/latest/libresign-logo.svg" class="btn ud-btn-solid-brand">
                {{ $page->t('Download LibreSign logo (SVG)') }}
              </a>
              <a href="https://github.com/LibreSign/brand/releases/download/latest/libresign-logo.png" class="btn ud-btn-ghost">
                {{ $page->t('Download LibreSign logo (PNG)') }}
              </a>
            </p>
            <p>{{ $page->t('The current LibreSign digital brand system uses #184c4e as its primary teal and Montserrat as its official digital typeface. Do not infer logo colors from interface colors; always use the official artwork.') }}</p>
            <p>
              <a href="https://github.com/LibreSign/brand/releases/download/latest/libresign-brand-manual.pdf" class="btn ud-btn-solid-brand">
                {{ $page->t('Download current brand manual (PDF)') }}
              </a>
              <a href="https://github.com/LibreSign/brand" class="btn ud-btn-ghost" target="_blank" rel="noopener noreferrer">{{ $page->t('View canonical brand source') }}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
