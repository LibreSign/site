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
              <div class="ud-pricing-body">
                <ul>
                  {!! $page->markdownListToHtml($content->list) !!}
                </ul>
              </div>
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

  <h2 class="display-6 text-center mb-4">Compare plans</h2>

  <div class="table-responsive">
    <table class="table text-center">
      <thead>
        <tr>
          <th style="width: 34%;"></th>
          <th style="width: 22%;">Free</th>
          <th style="width: 22%;">Pro</th>
          <th style="width: 22%;">Enterprise</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row" class="text-start">Public</th>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
        </tr>
        <tr>
          <th scope="row" class="text-start">Private</th>
          <td></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
        </tr>
      </tbody>

      <tbody>
        <tr>
          <th scope="row" class="text-start">Permissions</th>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
        </tr>
        <tr>
          <th scope="row" class="text-start">Sharing</th>
          <td></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
        </tr>
        <tr>
          <th scope="row" class="text-start">Unlimited members</th>
          <td></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
        </tr>
        <tr>
          <th scope="row" class="text-start">Extra security</th>
          <td></td>
          <td></td>
          <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
        </tr>
      </tbody>
    </table>
  </div>

  <section id="testimonials" class="ud-testimonials">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-section-title mx-auto text-center">
            <h2>{{ $page->t('Need more features?') }}</h2>
          </div>
        </div>
      <div class="row">
        <div class="col-xl-6 col-lg-7 mx-auto p-2">
          <div class="ud-contact-content-wrapper">
            <div class="ud-contact-info-wrapper">
              <div class="ud-single-info border border-secondary-subtle rounded-bottom-1 rounded-top-1 p-3">
                <div class="ud-info-icon">
                  <i class="lni lni-cog"></i>
                </div>
                <div class="ud-info-meta">
                  <h5>API</h5>
                  <p>{{ $page->t("Maximize your workflow efficiency with LibreSign's API integration. Automate digital signature processes, minimize manual errors and improve security. Our API makes it easy to incorporate digital signature functionality into your existing systems.") }}</p>
                </div>
              </div>
              <div class="ud-single-info border border-secondary-subtle rounded-bottom-1 rounded-top-1 p-3">
                <div class="ud-info-icon">
                  <i class="lni lni-cloud-upload"></i>
                </div>
                <div class="ud-info-meta">
                  <h5>{{ $page->t('Cloud Storage') }}</h5>
                  <p>{{ $page->t('We offer flexible plans to meet your secure digital storage needs. Easily rent more space and ensure all your important documents are always accessible and protected in our high-security cloud.') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ud-pricing-footer text-center">
        <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-white-btn mt-1">
          {{ $page->t('Under Consultation') }}
        </a>
      </div>
    </div>
  </section>
@endsection
