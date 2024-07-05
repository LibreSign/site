@extends('_layouts.main')

@section('body')
 <section class="ud-hero" id="home">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-hero-content wow fadeInUp" data-aos-delay=".2s">
            <h1 class="ud-hero-title">
              {{ $page->t( "Our Pricing Plans") }}
            </h1>
            <p class="ud-hero-desc">
              {{ $page->t("Choose the perfect plan for your needs - Flexibility and security for companies of all sizes!") }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="pricing" class="ud-pricing">
    <div class="container">

      <div class="row g-0 align-items-center justify-content-center">
        @foreach ($page->prices as $planName => $content)
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div
              class="ud-single-pricing first-item{{ $content->isActive ? ' active' : ''}} wow fadeInUp"
              data-wow-delay=".15s"
            >
              <div class="ud-pricing-header">
                <h4 class="{{ $content->isActive ? ' ud-main-tag' : ''}}">{{$page->t($planName)}}</h4>
                @if ($content->description)
                  <h3>{{$page->t($content->description)}}</h3>
                @endif
                <h4>{{$page->t($content->price)}}</h4>
              </div>
              @if ($content->list)
                <div class="ud-pricing-body">
                  <ul>
                    {!! $page->markdownListToHtml($content->list) !!}
                  </ul>
                </div>
              @endif
              <div class="ud-pricing-footer">
                <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-border-btn">
                  {{ $page->t('Under Consultation') }}
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section id="pricing" class="ud-pricing">
    <div class="container">

      <h2 class="display-6 text-center mb-4">{{ $page->t('Compare plans')}}</h2>

      <div class="table-responsive">
        <table class="table text-center">

          <thead>
            <tr>
              <th style="width: 34%;"></th>
              <th style="width: 22%;">{{ $page->t('Basic') }}</th>
              <th style="width: 22%;">{{ $page->t('Business') }}</th>
            </tr>
          </thead>
          @foreach($page->optionsServicesLibresign as $item => $optionList)
          <tbody>
            <tr>
              <th scope="row" class="text-start">{{ $page->t($optionList->service) }}</th>
              @foreach (['basic', 'business'] as $item)
                <td>
                  @if (is_bool($optionList->$item))
                    <i class="lni lni-{{ $optionList->$item == true ? 'checkmark text-success' : 'close text-danger'}}"></i>
                  @else
                    {{ $page->t($optionList->$item) }}
                  @endif
                </td>
              @endforeach
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>

      <div class="ud-pricing-footer text-center mt-5">
        <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-white-btn mt-1">
          {{ $page->t('Under Consultation') }}
        </a>
      </div>

    </div>
  </section>

  <section id="testimonials" class="ud-testimonials">
    <div class="container">
      <div class="ud-section-title mx-auto text-center">
        <h2>{{ $page->t('Need more features?') }}</h2>
      </div>
      <div class="row justify-content-md-center">
        <div class="col-lg-5 mb-3">
          <div class="ud-single-info border border-secondary-subtle rounded-bottom-1 rounded-top-1 p-3">
            <div class="ud-info-icon mb-2">
              <i class="lni lni-cog fs-1"></i>
            </div>
            <div class="ud-info-meta">
              <h5 class="fs-4 mb-2">API</h5>
              <p>{{ $page->t("Maximize your workflow efficiency with LibreSign's API integration. Automate digital signature processes, minimize manual errors and improve security. Our API makes it easy to incorporate digital signature functionality into your existing systems.") }}</p>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="ud-single-info border border-secondary-subtle rounded-bottom-1 rounded-top-1 p-3">
            <div class="ud-info-icon mb-2">
              <i class="lni lni-cloud-upload fs-1"></i>
            </div>
            <div class="ud-info-meta pb-5">
              <h5 class="fs-4 mb-2">{{ $page->t('Cloud Storage') }}</h5>
              <p>{{ $page->t('We offer flexible plans to meet your secure digital storage needs. Easily rent more space and ensure all your important documents are always accessible and protected in our high-security cloud.') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="ud-pricing-footer text-center mt-5">
        <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-white-btn mt-1">
          {{ $page->t('Under Consultation') }}
        </a>
      </div>
    </div>
  </section>
@endsection
