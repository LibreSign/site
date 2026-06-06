@extends('_layouts.main')

@section('body')

  {{-- ====== Hero ====== --}}
  <section class="ud-ps-hero">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="ud-ps-hero__content">
            <span class="ud-ps-hero__label">{{ $page->t('Public Sector') }}</span>
            <h1 class="ud-ps-hero__title">
              {{ $page->t('Transparency, Validity, and Efficiency for Public Management.') }}
            </h1>
            <p class="ud-ps-hero__desc">
              {{ $page->t('Digitize bids, contracts, and administrative processes with total compliance and agility, respecting public value. LibreSign gives public organizations the security and traceability required by Brazilian legislation.') }}
            </p>
            <div class="ud-ps-hero__actions">
              <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn ud-ps-hero__primary-btn">
                {{ $page->t('Request a Demonstration') }}
              </a>
              <a href="{{ locale_url($page, 'register') }}" class="ud-secondary-btn">
                {{ $page->t('Try for Free') }}
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="ud-ps-hero__illustration">
            <img
              src="{{ $page->baseUrl }}assets/images/solutions/public-sector.svg"
              alt="{{ $page->t('Public sector digital signature illustration') }}"
              class="ud-ps-hero__svg"
            />
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ====== Challenges ====== --}}
  <section class="ud-ps-challenges">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="ud-section-title mx-auto">
            <h2>{{ $page->t('The Challenges of Public Management that LibreSign Solves.') }}</h2>
          </div>
          <p class="ud-ps-section__subtitle">
            {{ $page->t('We understand the operational and legal complexity of public organizations. See how LibreSign addresses the most critical demands.') }}
          </p>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-2">
        <div class="col">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-file-multiple" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Paper-Based and Slow Processes') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Manual handling of bids, contracts, and official correspondence creates bottlenecks, increases risk of loss, and delays public services.') }}
            </p>
          </div>
        </div>
        <div class="col">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-shield-2-check" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Legal Compliance and LGPD') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Signatures must meet strict legal requirements. Ensuring authenticity, non-repudiation, and data protection under LGPD is non-negotiable for public bodies.') }}
            </p>
          </div>
        </div>
        <div class="col">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-eye" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Lack of Transparency and Traceability') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Citizens and auditors demand visibility into administrative processes. Without complete audit trails, accountability is compromised.') }}
            </p>
          </div>
        </div>
        <div class="col">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-locked-1" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Data Sovereignty and Vendor Lock-in') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t("Dependence on closed, proprietary systems restricts the organization's autonomy and makes public data hostage to third parties.") }}
            </p>
          </div>
        </div>
        <div class="col">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-gears-3" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Integration with Existing Systems') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Public organizations often run legacy management systems that need to communicate securely with new digital signature solutions.') }}
            </p>
          </div>
        </div>
        <div class="col">
          <div class="ud-ps-challenge-card">
            <div class="ud-ps-challenge-card__icon">
              <i class="lni lni-user-multiple-4" aria-hidden="true"></i>
            </div>
            <h3 class="ud-ps-challenge-card__title">{{ $page->t('Resistance and User Adoption') }}</h3>
            <p class="ud-ps-challenge-card__body">
              {{ $page->t('Transitioning entire departments to digital workflows requires an intuitive, accessible platform that reduces training time and friction.') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ====== Solutions ====== --}}
  <section class="ud-ps-solutions">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="ud-section-title mx-auto">
            <h2>{{ $page->t('How LibreSign Empowers Public Organizations.') }}</h2>
          </div>
          <p class="ud-ps-section__subtitle">
            {{ $page->t('A complete, open, and auditable platform built to meet the demands of public administration.') }}
          </p>
        </div>
      </div>
      <div class="row g-5 mt-2 align-items-center">
        <div class="col-lg-6">
          <div class="ud-ps-solution-list">
            <div class="ud-ps-solution-item" data-aos="fade-right">
              <div class="ud-ps-solution-item__icon">
                <i class="lni lni-certificate-badge-1" aria-hidden="true"></i>
              </div>
              <div class="ud-ps-solution-item__content">
                <h3>{{ $page->t('ICP-Brasil Digital Certificate Support') }}</h3>
                <p>{{ $page->t('Full support for A1 and A3 digital certificates issued by ICP-Brasil, ensuring legal validity for all signed documents under Brazilian law.') }}</p>
              </div>
            </div>
            <div class="ud-ps-solution-item" data-aos="fade-right" data-aos-delay="100">
              <div class="ud-ps-solution-item__icon">
                <i class="lni lni-check-circle-1" aria-hidden="true"></i>
              </div>
              <div class="ud-ps-solution-item__content">
                <h3>{{ $page->t('Complete Audit Trails') }}</h3>
                <p>{{ $page->t('Every signature event is logged with timestamp, IP, certificate data, and document hash — providing a tamper-proof history for any compliance audit.') }}</p>
              </div>
            </div>
            <div class="ud-ps-solution-item" data-aos="fade-right" data-aos-delay="200">
              <div class="ud-ps-solution-item__icon">
                <i class="lni lni-gear-1" aria-hidden="true"></i>
              </div>
              <div class="ud-ps-solution-item__content">
                <h3>{{ $page->t('REST API for System Integration') }}</h3>
                <p>{{ $page->t('Seamlessly connect LibreSign to management systems like e-Cidade, Nextcloud, or any internal system via our well-documented REST API.') }}</p>
              </div>
            </div>
            <div class="ud-ps-solution-item" data-aos="fade-right" data-aos-delay="300">
              <div class="ud-ps-solution-item__icon">
                <i class="lni lni-code-1" aria-hidden="true"></i>
              </div>
              <div class="ud-ps-solution-item__content">
                <h3>{{ $page->t('Free and Open Source Software') }}</h3>
                <p>{{ $page->t('Full source code available for audit, customization, and self-hosting. No vendor lock-in — your data stays under your control, on your infrastructure.') }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
          <div class="ud-ps-stats">
            <div class="ud-ps-stat">
              <span class="ud-ps-stat__number">100%</span>
              <span class="ud-ps-stat__label">{{ $page->t('LGPD Compliant') }}</span>
            </div>
            <div class="ud-ps-stat">
              <span class="ud-ps-stat__number">ICP-Brasil</span>
              <span class="ud-ps-stat__label">{{ $page->t('Digital Certificate Standard') }}</span>
            </div>
            <div class="ud-ps-stat">
              <span class="ud-ps-stat__number">AGPL</span>
              <span class="ud-ps-stat__label">{{ $page->t('Open Source License') }}</span>
            </div>
            <div class="ud-ps-stat">
              <span class="ud-ps-stat__number">{{ $page->t('Self-hosted') }}</span>
              <span class="ud-ps-stat__label">{{ $page->t('Full data sovereignty') }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ====== Testimonial ====== --}}
  <section class="ud-ps-testimonial">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <blockquote class="ud-ps-quote">
            <p class="ud-ps-quote__text">
              "{{ $page->t('A simple and complete solution. It speeds up processes and can eliminate the use of paper. We integrated it with our public management system e-Cidade — it was absurdly good. Congratulations.') }}"
            </p>
            <footer class="ud-ps-quote__author">
              <strong>Igor Afonso Oliveira Ruas</strong>
              <span>{{ $page->t('Public Administration') }}</span>
            </footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>

  {{-- ====== CTA ====== --}}
  <section class="ud-ps-cta">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-8">
          <h2 class="ud-ps-cta__title">
            {{ $page->t('Ready to Transform Public Document Management?') }}
          </h2>
          <p class="ud-ps-cta__desc">
            {{ $page->t("Join the public organizations that already trust LibreSign to digitize their processes with security, transparency, and full legal compliance. Let's talk.") }}
          </p>
          <div class="ud-ps-cta__actions">
            <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn">
              {{ $page->t('Request a Personalized Demo') }}
            </a>
            <a href="{{ locale_url($page, 'register') }}" class="ud-secondary-btn">
              {{ $page->t('Try it For Free') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
