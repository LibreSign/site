@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->t( "Documentation") }}</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Banner End ====== -->

    <section class="ud-blog-grids">
        <navigation></navigation>
        <div class="container">
          
          <section class="ud-404">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="ud-404-wrapper">
                    <div class="ud-404-content">
                      <h2 class="ud-404-title">{{ $page->t( "This documents the upcoming version of Libresign") }}</h2>
                      <ul class="ud-404-links">
                        <li>
                          <a href="{{ $page->baseUrl }}docs/user/instalation">{{ $page->t( "User") }}</a>
                        </li>
                        <li>
                          <a href="{{ $page->baseUrl }}docs/admin/instalation">{{ $page->t( "Admin") }}</a>
                        </li>
                        <li>
                          <a href="{{ $page->baseUrl }}docs/developer/instalation">{{ $page->t( "Developer") }}</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        </div>
      </section>

@endsection