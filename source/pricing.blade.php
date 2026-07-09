---
title: "LibreSign Plans and Pricing - Featured commercial options"
description: "Browse public LibreSign plans and featured WooCommerce subscriptions synchronized during the static site build."
---
@extends('_layouts.main')

@section('body')

  {{-- Hero --}}
  <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>{{ $page->t("LibreSign Plans and Pricing") }}</h1>
            <p>{{ $page->t("LibreSign is preparing commercial plans for organizations that need support, managed services, cloud infrastructure, integrations, or dedicated guidance.") }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Talk to our team --}}
  <section class="py-5 bg-light text-center" id="contact-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <h2 class="fw-bold mb-3">{{ $page->t("Talk to our team") }}</h2>
          <p class="fs-5 text-muted mb-4">
            {{ $page->t("While public pricing is not yet available, our team can help you understand the best option for your organization.") }}
          </p>
          <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-solid-brand">
            {{ $page->t("Talk to our team") }}
          </a>
        </div>
      </div>
    </div>
  </section>

  {{-- Available commercial options --}}
  <section class="py-5 bg-white" id="pricing-plans">
    <div class="container py-4">
      <h2 class="display-6 fw-bold text-center mb-5">{{ $page->t("Available commercial options") }}</h2>
      <div class="row g-4 align-items-stretch justify-content-center">

        <div class="col-lg-4 col-md-6 col-sm-10">
          <div class="ud-single-pricing h-100">
            <div class="ud-pricing-header">
              <h3>{{ $page->t("Business") }}</h3>
              <p class="ud-pricing-tagline">{{ $page->t("For organizations that need support, guidance, and a tailored LibreSign adoption path.") }}</p>
            </div>
            <div class="ud-pricing-footer">
              <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-outline-brand">
                {{ $page->t("Request information") }}
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-10">
          <div class="ud-single-pricing h-100">
            <div class="ud-pricing-header">
              <h3>{{ $page->t("API Integration") }}</h3>
              <p class="ud-pricing-tagline">{{ $page->t("For organizations that want to integrate LibreSign with existing systems and workflows.") }}</p>
            </div>
            <div class="ud-pricing-footer">
              <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-outline-brand">
                {{ $page->t("Discuss integration") }}
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-10">
          <div class="ud-single-pricing h-100">
            <div class="ud-pricing-header">
              <h3>{{ $page->t("Cloud and Managed Services") }}</h3>
              <p class="ud-pricing-tagline">{{ $page->t("For organizations interested in hosted or managed infrastructure options when available.") }}</p>
            </div>
            <div class="ud-pricing-footer">
              <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-outline-brand">
                {{ $page->t("Contact us") }}
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
