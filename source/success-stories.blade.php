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
              <div class="ud-testimonial-ratings" aria-label="{{ $page->t('5 out of 5 stars') }}">
                <i class="lni lni-star-fat" aria-hidden="true"></i>
                <i class="lni lni-star-fat" aria-hidden="true"></i>
                <i class="lni lni-star-fat" aria-hidden="true"></i>
                <i class="lni lni-star-fat" aria-hidden="true"></i>
                <i class="lni lni-star-fat" aria-hidden="true"></i>
              </div>
              <blockquote class="ud-testimonial-content flex-grow-1">
                <p>{{ $testimonial['comment'] }}</p>
              </blockquote>
              <footer class="ud-testimonial-info">
                <div class="ud-testimonial-author">
                  <h3 class="ud-testimonial-name">{{ $testimonial['author'] }}</h3>
                </div>
              </footer>
            </article>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
