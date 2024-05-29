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
        <div class="col-lg-4 col-md-6 col-sm-10">
          <div
            class="ud-single-pricing first-item wow fadeInUp"
            data-wow-delay=".15s"
          >
            <div class="ud-pricing-header">
              <h4>{{$page->t('Basic')}}</h4>
              <h3>{{$page->t('STARTING FROM')}}</h3>
              <h4>{{$page->t('$ 600/mo')}}</h4>
            </div>
            <div class="ud-pricing-body">
              <ul>
                <li>{{ $page->t('until 5 users') }}</li>
                <li>{{ $page->t('unlimited subscriptions') }}</li>
                <li>{{ $page->t('1 GB') }}</li>
                <li>{{ $page->t('Technical support in configuring up to 2 documents') }}</li>
                <li>{{ $page->t('Unlimited subscription with A1 digital certificate') }}</li>
                <li>{{ $page->t('Cloud storage and electronic document management') }}</li>
                <li>{{ $page->t('Triggering email reminders') }}</li>
                <li class="text-decoration-line-through">{{ $page->t('Online document creation and editing') }}</li>
                <li class="text-decoration-line-through">{{ $page->t('Access control by user or sector level') }}</li>
                <li class="text-decoration-line-through">{{ $page->t('Task control and management') }}</li>
                <li class="text-decoration-line-through">{{ $page->t('Customization of visual identity (colors, logo and domain)') }}</li>
              </ul>
            </div>
            <div class="ud-pricing-footer">
              <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-border-btn">
                {{ $page->t('Under Consultation') }}
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-10">
          <div
            class="ud-single-pricing active wow fadeInUp"
            data-wow-delay=".15s"
          >
            <div class="ud-pricing-header">
                <h4 class="my-5">{{ $page->t('Business') }}</h4>
              <h3 class="my-5">{{ $page->t("Contact us to more informations") }}</h3>
            </div>
            <div class="ud-pricing-body">
              <ul>
                <li>{{ $page->t('Unlimited user number') }}</li>
                <li>{{ $page->t('unlimited subscriptions') }}</li>
                <li>{{ $page->t('Starting from 1 GB') }}</li>
                <li>{{ $page->t('Chat and Email') }}</li>
                <li>{{ $page->t('Unlimited subscription with A1 digital certificate') }}</li>
                <li>{{ $page->t('Cloud storage and electronic document management') }}</li>
                <li>{{ $page->t('Triggering email reminders') }}</li>
                <li>{{ $page->t('Online document creation and editing') }}</li>
                <li>{{ $page->t('Access control by user or sector level') }}</li>
                <li>{{ $page->t('Task control and management') }}</li>
                <li>{{ $page->t('Customization of visual identity (colors, logo and domain)') }}</li>
              </ul>
            </div>
            <div class="ud-pricing-footer">
              <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-white-btn mt-1">
                {{ $page->t('Under Consultation') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
