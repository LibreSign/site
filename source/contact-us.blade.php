@extends('_layouts.main')

@section('body')
  <section class="ud-hero" id="home">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-hero-content wow fadeInUp" data-aos-delay=".2s">
            <h1 class="ud-hero-title">{{ $page->t('Contact') }}</h1>
            <p class="ud-hero-desc">
              {{ $page->t('Fill in the fields below with your data') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('_partials/contact_form')
@endsection
