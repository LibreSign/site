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
              {{ $page->t("There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form.") }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!-- ====== Pricing Start ====== -->
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
                    <li class="text-decoration-line-through">{{ $page->t('Customization of visual identity (colors, logo and domain') }}</li>
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
                class="ud-single-pricing last-item wow fadeInUp"
                data-wow-delay=".15s"
              >
                <div class="ud-pricing-header">
                    <h4>{{ $page->t('Business') }}</h4>
                  <h3 class="my-5">{{ $page->t("Contact us \r to more informations") }}</h3>
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
                  <a href="{{ locale_path($page, $page->baseUrl) }}contact-us" class="ud-main-btn ud-border-btn mt-4">
                    {{ $page->t('Under Consultation') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Pricing End ====== -->
@endsection