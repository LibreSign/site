@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->t( "Blog Page") }}</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Blog Start ====== -->
    <section class="ud-blog-grids">
      <div class="container">
        <div class="row">
          @foreach ($posts as $post)
            @if (current_path_locale($post) !== current_path_locale($page))
              @continue
            @endif
            <div class="col-lg-4 col-md-6">
              <div class="ud-single-blog">
                <div class="ud-blog-image">
                  <a href="{{ $post->getUrl() }}">
                    <img src="{{ $post->cover_image }}" alt="{{ $page->t($post->title) }}" />
                  </a>
                </div>
                <div class="ud-blog-content">
                  <span class="ud-blog-date">{{ date('F j, Y', $post->date) }}</span>
                  <h3 class="ud-blog-title">
                    <a href="{{ $post->getUrl() }}">
                      {{ $page->t($post->title) }}
                    </a>
                  </h3>
                  <p class="ud-blog-desc">
                    {{ $page->t($post->description) }}
                  </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
@endsection