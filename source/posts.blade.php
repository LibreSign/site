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
          @foreach ($page->mergeCollections($posts, $posts_wordpress) as $post)
            @if (current_path_locale($post) !== current_path_locale($page))
              @continue
            @endif
            <div class="col-lg-4 col-md-6">
              <div class="ud-single-blog">
                <div class="ud-blog-image">
                  <a href="{{ $post->getUrl() }}">
                    <img src="{{ $post->cover_image }}" alt="" />
                  </a>
                </div>
                <div class="ud-blog-content">
                  @php
                    Carbon\Carbon::setLocale(current_path_locale($page))
                  @endphp
                  <span class="ud-blog-date">{{ Carbon\Carbon::createFromTimestamp($post->date)->isoFormat('ll') }}</span>

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
