@extends('_layouts.main')

@section('body')

  <!-- ====== Hero Start ====== -->
  <section class="ud-hero" id="home">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
            <h1 class="ud-hero-title"> 
            {{ $page->t('Contributing Page')}} 
            </h1>
          </div>
      </div>
    </div>
  </section>
  
  <!-- Contributing Form -->
  @include('_partials/contributing_form')
@endsection