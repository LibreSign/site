---
title: "LibreSign Pricing - Digital Signature Plans for Organizations"
description: "Explore LibreSign plans for teams and organizations. Secure, self-hosted digital signature solutions built on Nextcloud. Contact us for pricing details."
---
@extends('_layouts.main')

@section('body')

  {{-- Hero compacto: sem imagem, usa o helper dark existente --}}
  <section class="ud-page-section--dark text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <h1 class="display-4 fw-bold text-white mb-3">
            {{ $page->t("Our Pricing Plans") }}
          </h1>
          <p class="fs-5 text-white-50">
            {{ $page->t("Choose the perfect plan for your needs - Flexibility and security for companies of all sizes!") }}
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- Cards de planos --}}
  <section class="py-5 bg-white" id="pricing-plans">
    <div class="container py-4">
      <div class="row g-4 align-items-stretch justify-content-center">
        @foreach ($page->prices as $planName => $content)
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div class="ud-single-pricing h-100{{ $content->isActive ? ' active' : '' }}">
              <div class="ud-pricing-header">
                @if ($content->isActive)
                  <h3 class="ud-main-tag">{{ $page->t($planName) }}</h3>
                @else
                  <h3>{{ $page->t($planName) }}</h3>
                @endif
                @if ($content->description)
                  <p class="ud-pricing-tagline">{{ $page->t($content->description) }}</p>
                @endif
                <p class="ud-pricing-price">{{ $page->t($content->price) }}</p>
              </div>
              @if ($content->list)
                <div class="ud-pricing-body">
                  <ul>
                    {!! $page->markdownListToHtml($content->list) !!}
                  </ul>
                </div>
              @endif
              <div class="ud-pricing-footer">
                <a href="{{ locale_url($page, 'contact-us') }}" class="btn {{ $content->isActive ? 'ud-btn-solid-white' : 'ud-btn-outline-brand' }}">
                  {{ $page->t('Talk to Our Team') }}
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Tabela de detalhes do plano --}}
  <section class="py-5 bg-light" id="plan-details">
    <div class="container">

      @php
        $comparePlans = array_map(static fn ($planName) => [
          'key' => strtolower($planName),
          'label' => $planName,
        ], array_keys((array) $page->prices));

        $comparisonRows = array_values(array_filter(
          (array) $page->optionsServicesLibresign,
          static function ($optionList) use ($comparePlans): bool {
            foreach ($comparePlans as $plan) {
              $value = $optionList->{$plan['key']} ?? null;
              if (is_bool($value) || (is_string($value) && $value !== '') || is_numeric($value)) {
                return true;
              }
            }
            return false;
          }
        ));
      @endphp

      <h2 class="display-6 fw-bold text-center mb-4">{{ $page->t(count($comparePlans) > 1 ? 'Compare plans' : 'Plan details') }}</h2>

      @if (!empty($comparisonRows))
        <div class="table-responsive">
          <table class="table table-striped text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th class="text-start" style="width: 55%;">{{ $page->t('Feature') }}</th>
                @foreach ($comparePlans as $plan)
                  <th>{{ $page->t($plan['label']) }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($comparisonRows as $optionList)
                <tr>
                  <th scope="row" class="text-start fw-normal">{{ $page->t($optionList->service) }}</th>
                  @foreach ($comparePlans as $plan)
                    @php($planValue = $optionList->{$plan['key']} ?? null)
                    <td>
                      @if (is_bool($planValue))
                        <span class="{{ $planValue ? 'text-success' : 'text-danger' }} fw-semibold">
                          <i class="lni lni-{{ $planValue ? 'check' : 'xmark' }}"></i>
                        </span>
                      @elseif (is_string($planValue) && $planValue !== '')
                        {{ $page->t($planValue) }}
                      @elseif (is_numeric($planValue))
                        {{ $planValue }}
                      @else
                        <span class="text-muted">—</span>
                      @endif
                    </td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-center">{{ $page->t('This plan does not include a comparison table.') }}</p>
      @endif

    </div>
  </section>

  {{-- Extras: API e Storage --}}
  <section class="ud-page-section--dark" id="extras">
    <div class="container">
      <h2 class="text-white fw-bold text-center mb-5">{{ $page->t('Need more features?') }}</h2>
      <div class="row justify-content-center g-4">
        <div class="col-lg-5">
          <div class="rounded-3 p-4 h-100 bg-white bg-opacity-10 border border-white border-opacity-25 text-white">
            <div class="mb-3"><i class="lni lni-gear-1 fs-1"></i></div>
            <h3 class="fs-4 fw-bold mb-3">API</h3>
            <p class="text-white-50 mb-0">{{ $page->t("Maximize your workflow efficiency with LibreSign's API integration. Automate digital signature processes, minimize manual errors and improve security. Our API makes it easy to incorporate digital signature functionality into your existing systems.") }}</p>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="rounded-3 p-4 h-100 bg-white bg-opacity-10 border border-white border-opacity-25 text-white">
            <div class="mb-3"><i class="lni lni-cloud-upload fs-1"></i></div>
            <h3 class="fs-4 fw-bold mb-3">{{ $page->t('Cloud Storage') }}</h3>
            <p class="text-white-50 mb-0">{{ $page->t('We offer flexible plans to meet your secure digital storage needs. Easily rent more space and ensure all your important documents are always accessible and protected in our high-security cloud.') }}</p>
          </div>
        </div>
      </div>
      <div class="text-center mt-5">
        <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-ghost">
          {{ $page->t('Talk to Our Team') }}
        </a>
      </div>
    </div>
  </section>

@endsection
