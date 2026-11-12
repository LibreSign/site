---
title: "LibreSign Success Stories - Organizations Using Open Source Digital Signatures"
description: "See how organizations use LibreSign to sign documents securely, reduce bureaucracy, and maintain control over their data with a self-hosted open source platform."
---
@extends('_layouts.main')

@section('body')
  <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>{{ $page->t("Success Stories") }}</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-testimonials py-5">
    <div class="container">
      <div class="row g-4 justify-content-center align-items-stretch">
        @foreach($page->testimonials as $testimonial)
          <div class="col-lg-4 col-md-6 d-flex">
            <article class="ud-single-testimonial d-flex flex-column w-100">
              <blockquote class="ud-testimonial-content flex-grow-1">
                <p>{{ $page->t($testimonial['description']) }}</p>
              </blockquote>
              <footer class="ud-testimonial-info">
                <div class="ud-testimonial-author">
                  <h3 class="ud-testimonial-name">{{ $testimonial['author'] }}</h3>
                  @if (!empty($testimonial['affiliation']))
                    <p class="small mb-1">{{ $page->t($testimonial['affiliation']) }}</p>
                  @endif
                  @if (!empty($testimonial['origin']))
                    <p class="small mb-0">
                      {{ $page->t('Source') }}:
                      @if (!empty($testimonial['url']))
                        <a href="{{ $testimonial['url'] }}" target="_blank" rel="noopener noreferrer">
                          {{ $page->t($testimonial['origin']) }}
                        </a>
                      @else
                        {{ $page->t($testimonial['origin']) }}
                      @endif
                    </p>
                  @endif
                </div>
              </footer>
            </article>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
