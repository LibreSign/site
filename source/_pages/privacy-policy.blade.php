@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->t("Privacy policy",current_path_locale($page))}}</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Blog Details Start ====== -->
    <section class="ud-blog-details">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div>
              @include('_privacy-policy-term.privacy-policy-term')
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog Details End ====== -->
@endsection