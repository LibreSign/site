---
title: "LibreSign FAQ - Digital Signature Questions Answered"
description: "Answers to common questions about LibreSign: how it works, digital certificates, legal validity, cancellation, plans, and more."
---
@extends('_layouts.main')

@section('body')

  <section class="ud-page-section--dark text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <h1 class="display-4 fw-bold text-white mb-3">
            {{ $page->t("Frequently Asked Questions") }}
          </h1>
          <p class="fs-5 text-white-50">
            {{ $page->t("Everything you need to know about LibreSign.") }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-faq" aria-labelledby="faq-section-heading">
    <div class="shape" aria-hidden="true">
      <img src="{{ $page->baseUrl }}assets/images/faq/shape.svg" alt="">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-section-title text-center mx-auto">
            <h2 id="faq-section-heading">{{ $page->t("LibreSign frequently asked questions")}}</h2>
          </div>
        </div>
      </div>

      <div class="row">
        @foreach($page->frequentlyQuestions as $item => $frequentlyQuestion)
          <div class="col-lg-6">
            <div class="ud-single-faq" data-aos="fade-up" data-aos-delay="{{ $item * 100 }}">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#faq-item-{{ $item }}"
                  aria-expanded="false"
                  aria-controls="faq-item-{{ $item }}"
                >
                  <span class="icon flex-shrink-0" aria-hidden="true">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>{{ $page->t($frequentlyQuestion->question)}}</span>
                </button>
                <div id="faq-item-{{ $item }}" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ $page->t($frequentlyQuestion->answer)}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="text-center mt-5 pt-2">
        <p class="mb-4">{{ $page->t('Still have questions? Our team is ready to help.') }}</p>
        <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-solid-brand">
          {{ $page->t('Talk to Our Specialists') }}
        </a>
      </div>
    </div>
  </section>

@push('structured-data')
@php
  $faqEntities = [];
  foreach ($page->frequentlyQuestions as $fq) {
    $faqEntities[] = [
      '@type' => 'Question',
      'name' => $fq->question,
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => $fq->answer,
      ],
    ];
  }
  $faqJsonLd = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $faqEntities,
  ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp
<script type="application/ld+json">
{!! $faqJsonLd !!}
</script>
@endpush

@endsection
