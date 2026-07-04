---
title: "LibreSign Plans and Pricing - Featured commercial options"
description: "Browse public LibreSign plans and featured WooCommerce subscriptions synchronized during the static site build."
---
@extends('_layouts.main')

@section('body')

  @php
    $pricingStyleBuilder = new \App\Support\Pricing\PricingStyleBuilder();
    $pricingPageData = (new \App\Support\Pricing\PricingPageBuilder())->build(
      collect($products_wordpress ?? []),
      current_path_locale($page) ?: packageDefaultLocale($page),
      packageDefaultLocale($page),
    );
    $productEntries = $pricingPageData['productEntries'];
    $comparisonProducts = $pricingPageData['comparisonProducts'];
    $comparisonFeatureGroups = $pricingPageData['comparisonFeatureGroups'];
    $detailRows = $pricingPageData['detailRows'];
  @endphp

  {{-- Hero --}}
  <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>{{ $page->t('Choose your plan and start signing today') }}</h1>
            <p>{{ $page->t('Digital signatures with legal validity, enterprise-grade security, and seamless integration with the systems you already use. No per-user fees. No extra charges per document.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-white" id="pricing-plans">
    <div class="container py-4">
      <h2 class="display-6 fw-bold text-center mb-5">{{ $page->t('Featured products') }}</h2>
      <div class="row g-4 align-items-stretch justify-content-center">

        @forelse ($productEntries as $productEntry)
          @php
            $product = $productEntry['product'];
            $price = $product->price ?? null;
            $detailAttributes = $productEntry['detailAttributes'] ?? [];
            $hasPriceRange = $product->hasPriceRange ?? false;
            $permalink = $product->permalink ?? '#';
            $buttonLabel = !empty($product->buttonLabel) ? $product->buttonLabel : $page->t('View product');
            $cardHighlights = $productEntry['cardHighlights'] ?? [];
            $pricingCardStyle = $pricingStyleBuilder->buildCardStyle((array) ($product->pricingCardColors ?? []));
          @endphp
          <div class="col-lg-4 col-md-6 col-sm-10 d-flex">
            <div class="pricing-plan-card" style="{{ $pricingCardStyle }}">
              <div class="pricing-plan-card__header">
                <h3 class="pricing-plan-card__name">{{ $product->title }}</h3>

                @if ($price)
                  <div>
                    @if ($hasPriceRange)
                      <span class="pricing-plan-card__price-label">{{ $page->t('STARTING FROM') }}</span>
                    @endif

                    <div class="pricing-plan-card__price">{{ $price }}</div>
                  </div>
                @endif
              </div>

              @if (!empty($detailAttributes))
                <div class="pricing-plan-card__meta text-start">
                  @foreach ($detailAttributes as $attribute)
                    <span class="pricing-plan-card__meta-item">
                      <strong>{{ $attribute['name'] }}</strong>
                      <span>{{ implode(', ', $attribute['values']) }}</span>
                    </span>
                  @endforeach
                </div>
              @endif

              @if (!empty($cardHighlights))
                <hr class="pricing-plan-card__divider">

                <ul class="pricing-plan-card__features">
                  @foreach ($cardHighlights as $cardHighlight)
                    <li class="pricing-plan-card__feature @if (($cardHighlight['type'] ?? 'feature') === 'inherited') pricing-plan-card__feature--inherited @endif">
                      <span class="pricing-plan-card__check" aria-hidden="true">✓</span>
                      <span>
                        @if (($cardHighlight['type'] ?? 'feature') === 'inherited')
                          {{ sprintf($page->t($cardHighlight['label'] ?? 'Everything in %s and more'), $cardHighlight['context'] ?? '') }}
                        @else
                          {{ $cardHighlight['label'] ?? '' }}
                        @endif
                      </span>
                    </li>
                  @endforeach
                </ul>
              @endif

              <div class="mt-auto">
                <a href="{{ $permalink }}" class="pricing-plan-card__button">
                  {{ $buttonLabel }}
                </a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-lg-8">
            <div class="alert alert-light border text-center py-5 px-4 mb-0">
              <p class="mb-0">{{ $page->t('No featured products are available right now. Please contact our team for current commercial options.') }}</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  @if ($comparisonFeatureGroups->isNotEmpty() || $detailRows->isNotEmpty())
    <section class="py-5 bg-light" id="pricing-comparison">
      <div class="container py-4">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="text-center mb-5">
              <h2 class="display-6 fw-bold mb-0">{{ $page->t('Compare plans') }}</h2>
            </div>

            <div
              class="bg-white rounded-4 shadow-sm overflow-hidden pricing-comparison-shell"
              style="--comparison-plan-count: {{ max($comparisonProducts->count(), 1) }};"
            >
              <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0 pricing-comparison-table">
                  <thead class="table-light">
                    <tr class="pricing-comparison-header-row">
                      <th scope="col" class="pricing-comparison-feature-column position-sticky start-0 bg-light text-uppercase small text-muted" style="min-width: 14rem; z-index: 2;">{{ $page->t('Features') }}</th>
                      @foreach ($comparisonProducts as $comparisonProduct)
                        @php
                          $comparisonPlanHeaderStyle = $pricingStyleBuilder->buildComparisonHeaderStyle(
                            (array) ($comparisonProduct['pricingCardColors'] ?? [])
                          );
                        @endphp
                        <th scope="col" class="text-center text-nowrap px-3 py-4 pricing-comparison-plan-heading" style="{{ $comparisonPlanHeaderStyle }}">{{ $comparisonProduct['title'] }}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($comparisonFeatureGroups as $comparisonFeatureGroup)
                      <tr class="table-light pricing-comparison-group-row">
                        <th scope="colgroup" colspan="{{ $comparisonProducts->count() + 1 }}" class="pricing-comparison-group-heading position-sticky start-0 bg-light text-uppercase small text-muted" style="z-index: 2;">{{ $page->t($comparisonFeatureGroup['label'] ?? 'Features') }}</th>
                      </tr>
                      @foreach ($comparisonFeatureGroup['rows'] as $featureRow)
                        <tr class="pricing-comparison-data-row">
                          <th scope="row" class="pricing-comparison-feature-label position-sticky start-0 bg-white fw-semibold" style="min-width: 14rem; z-index: 1;">{{ $featureRow['label'] }}</th>
                          @foreach ($featureRow['products'] as $comparisonProduct)
                            <td class="pricing-comparison-feature-value text-center px-3 py-3" data-plan-title="{{ $comparisonProduct['title'] }}">
                              @if ($comparisonProduct['included'])
                                <span class="text-success fw-bold fs-5 lh-1" aria-hidden="true">✓</span>
                                <span class="visually-hidden">{{ $page->t('Included') }}</span>
                              @else
                                <span class="text-body-secondary">—</span>
                                <span class="visually-hidden">{{ $page->t('Not included') }}</span>
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      @endforeach
                    @endforeach

                    @if ($detailRows->isNotEmpty())
                      <tr class="table-light pricing-comparison-group-row">
                        <th scope="colgroup" colspan="{{ $comparisonProducts->count() + 1 }}" class="pricing-comparison-group-heading position-sticky start-0 bg-light text-uppercase small text-muted" style="z-index: 2;">{{ $page->t('Plan details') }}</th>
                      </tr>
                    @endif

                    @foreach ($detailRows as $row)
                      <tr class="pricing-comparison-data-row">
                        <th scope="row" class="pricing-comparison-feature-label position-sticky start-0 bg-white fw-semibold" style="min-width: 14rem; z-index: 1;">{{ $row['label'] }}</th>
                        @foreach ($row['products'] as $comparisonProduct)
                          <td class="pricing-comparison-detail-value px-3 py-3" data-plan-title="{{ $comparisonProduct['title'] }}">
                            @if (!empty($comparisonProduct['values']))
                              @if (count($comparisonProduct['values']) === 1)
                                <span class="fw-semibold">{{ $comparisonProduct['values'][0] }}</span>
                              @else
                                <ul class="pricing-comparison-detail-list list-unstyled mb-0">
                                  @foreach ($comparisonProduct['values'] as $value)
                                    <li class="pricing-comparison-detail-item d-flex mb-2">
                                      <span class="me-2 text-primary">•</span>
                                      <span>{{ $value }}</span>
                                    </li>
                                  @endforeach
                                </ul>
                              @endif
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
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <section class="py-5 bg-light text-center" id="contact-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <h2 class="fw-bold mb-3">{{ $page->t('Need more features?') }}</h2>
          <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-solid-brand">
            {{ $page->t('Talk to sales') }}
          </a>
        </div>
      </div>
    </div>
  </section>

@endsection
