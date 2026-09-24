---
title: "LibreSign Brand and Pronunciation"
description: "Official guidance for the LibreSign name, pronunciation, visual identity resources, and relationship to the LibreCode Coop brand family."
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
            <p>{{ $page->t('LibreSign was named after LibreCode, which in turn was inspired by LibreOffice. Libre refers to freedom and the free-software tradition.') }}</p>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="ud-about-story__text">
            <h2>{{ $page->t('Pronunciation') }}</h2>
            <p><strong>Libre</strong>: <span aria-label="{{ $page->t('International Phonetic Alphabet transcription') }}">/ˈli.bɾe/</span>. {{ $page->t('It begins with an ee sound, not “lye” as in “laibre”.') }}</p>
            <p><strong>LibreSign</strong>: <span aria-label="{{ $page->t('International Phonetic Alphabet transcription') }}">/ˈli.bɾe saɪn/</span>.</p>
            <p>{{ $page->t('Sign keeps its English pronunciation. The pronunciation follows the same Libre identity used across the LibreCode brand family.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-about-values">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-10">
          <h2 class="ud-about-values__title">{{ $page->t('Visual identity resources') }}</h2>
          <p>{{ $page->t('Approved logos, variations, and brand-manual materials are available in the public LibreSign brand folder.') }}</p>
          <p>
            <a class="btn ud-btn-solid-brand"
               href="https://cloud.librecode.coop/s/HpkZbZZrsdn9Gqj"
               target="_blank"
               rel="noopener noreferrer">
              {{ $page->t('Open LibreSign brand assets') }}
            </a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-about-team">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="ud-about-team__content">
            <h2>{{ $page->t('Part of the LibreCode Coop brand family') }}</h2>
            <p>{{ $page->t('LibreSign has its own product identity, while shared naming and brand-family guidance is maintained by LibreCode Coop as the canonical institutional reference.') }}</p>
            <a href="https://librecode.coop/brand#libresign"
               class="btn ud-btn-ghost"
               target="_blank"
               rel="noopener noreferrer">
              {{ $page->t('See the LibreCode Coop brand guidelines') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
