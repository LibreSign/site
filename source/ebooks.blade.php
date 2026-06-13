---
title: "LibreSign E-books - Digital Signature Learning Resources"
description: "Free guides and e-books on digital signatures, document security, and open source software from the LibreSign team. New materials coming soon."
noindex: true
---
@extends('_layouts.main')

@section('body')
  <section class="ud-page-section--dark text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <h1 class="display-4 fw-bold text-white mb-3">
            {{ $page->t("E-books") }}
          </h1>
          <p class="fs-5 text-white-50">
            {{ $page->t("Free guides on digital signatures, document security, and open source software.") }}
          </p>
        </div>
      </div>
    </div>
  </section>

  @include('_partials.post-list', [
    'sectionClass' => 'ud-blog-grids',
    'format'       => 'blog',
    'category'     => 'ebook',
  ])

  @php $ebookPosts = $page->getFromCategory('ebook'); @endphp

  @if (empty(iterator_to_array($ebookPosts)) || count(iterator_to_array($ebookPosts)) === 0)
  <section class="py-5 text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <p class="fs-5 text-muted mb-4">{{ $page->t("New e-books and guides are being prepared. In the meantime, explore our blog for articles on digital signatures and open source software.") }}</p>
          <a href="{{ locale_url($page, 'posts') }}" class="btn ud-btn-solid-brand me-3">
            {{ $page->t("Visit our Blog") }}
          </a>
          <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-outline-brand">
            {{ $page->t("Contact Us") }}
          </a>
        </div>
      </div>
    </div>
  </section>
  @endif
@endsection
