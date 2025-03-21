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
              @yield('documentation_content')
            </div>
            <navigation-on-page :headings="pageHeadings"></navigation-on-page>
          </div>

        </div>
      </section>

@endsection