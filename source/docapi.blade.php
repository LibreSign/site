@extends('_layouts.main')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui.css">
@endpush

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
        <div class="container">
          
          <div class="row">
            <div class="col-4 p-5"> 

              @php
              $menuNavegation = $page->navigation->filter(function ($value, $key) use ($page) {
                  return strtolower($key) == $page->type;
              });
              @endphp
              
              @foreach($menuNavegation as $key => $value)
                <navigation :links='@json($value)'></navigation>
              @endforeach
            </div>
            <div class="col-8 p-5" style="background: #f3f4fe;">
                <div id="swagger-ui"></div>
            </div>
            <navigation-on-page :headings="pageHeadings"></navigation-on-page>
          </div>

        </div>
      </section>

@endsection


@push('scripts')
  <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-bundle.js" crossorigin></script>
  <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-standalone-preset.js" crossorigin></script>
  <script>
    window.onload = () => {
      window.ui = SwaggerUIBundle({
        url: 'https://raw.githubusercontent.com/LibreSign/libresign/refs/heads/main/openapi-full.json',
        dom_id: '#swagger-ui',
        presets: [
          SwaggerUIBundle.presets.apis,
          SwaggerUIStandalonePreset
        ],
        layout: "StandaloneLayout",
      });
    };
  </script>
@endpush