@extends('_layouts.main')

@section('body')
  <!-- ====== Contact/Sales Start ====== -->
  <section id="contact-sales" class="ud-contact-sales">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="contact-info-wrapper">
            <h1 class="contact-title">{{ $page->t('Boost Your Business with Digital Signature.') }}</h1>
            <p class="contact-subtitle">
              {{ $page->t('Fill out the form and schedule a conversation with one of our specialists to discover the ideal solution for your challenges.') }}
            </p>
            
            <h3 class="mt-5 mb-4">{{ $page->t('Why Schedule Your Conversation With Us?') }}</h3>
            <ul class="contact-benefits">
              <li>
                <strong>{{ $page->t('Personalized analysis:') }}</strong>
                {{ $page->t('we identify your challenges and show how LibreSign fits perfectly.') }}
              </li>
              <li>
                <strong>{{ $page->t('ROI calculation:') }}</strong>
                {{ $page->t('we demonstrate the return on investment and the economy your company will have.') }}
              </li>
              <li>
                <strong>{{ $page->t('Strategic solution:') }}</strong>
                {{ $page->t('we present a partnership vision for your growth.') }}
              </li>
              <li>
                <strong>{{ $page->t('Experienced consultants:') }}</strong>
                {{ $page->t('our team deeply understands the digital signature market and the needs of your sector.') }}
              </li>
              <li>
                <strong>{{ $page->t('Focus on your needs:') }}</strong>
                {{ $page->t('our specialists understand your challenges and build, in partnership, a 100% personalized proposal with LibreSign.') }}
              </li>
              <li>
                <strong>{{ $page->t('Fast return:') }}</strong>
                {{ $page->t('we contact you within 24 useful hours to schedule your conversation.') }}
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="contact-form-wrapper">
            @include('_partials/contact_form')
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== Contact/Sales End ====== -->
@endsection
