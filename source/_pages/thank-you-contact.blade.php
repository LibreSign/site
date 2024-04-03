@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="ud-banner-content">
                
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Banner End ====== -->
  
      <!-- ====== Error 404 Start ====== -->
      <section class="ud-404">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="ud-404-wrapper">
                <div class="ud-404-content">
                  <h2 class="ud-404-title">{{ $page->t( "Thank you!") }}</h2>
                  <h5 class="ud-404-subtitle">
                    {{ $page->t( "Maybe you can find what you need here?") }}
                  </h5>
                  <ul class="ud-404-links">
                    <li>
                      <a href="{{ $page->baseUrl }}">{{ $page->t( "Home") }}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Error 404 End ====== -->
@endsection