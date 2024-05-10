@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->t($page->title) }}</h1>
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
          @if ($page->banner)
            <div class="col-lg-12">
              <div class="ud-blog-details-image">
                <img
                  src="{{ $page->banner }}"
                  alt="blog details"
                />
                <div class="ud-blog-overlay">
                  <div class="ud-blog-overlay-content">
                    <div class="ud-blog-author">
                      <img src="https://www.gravatar.com/avatar/{{$page->gravatar}}?size=40"
                      alt="{{ $page->author }}" />
                      <span>
                        {{ $page->t("By") }} <a href="{{ $page->baseUrl }}team/{{ \Illuminate\Support\Str::slug($page->author) }}"> {{ $page->author }} </a>
                      </span>
                    </div>

                    <div class="ud-blog-meta">
                      <p class="date">
                        @php
                          Carbon\Carbon::setLocale(current_path_locale($page))
                        @endphp
                        <i class="lni lni-calendar"></i> <span>{{ Carbon\Carbon::createFromTimestamp($page->date)->isoFormat('ll') }}</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif

          <div class="col-lg-8">
            <div class="ud-blog-details-content text-justify">
              <div style="text-align:justify;">
                @yield('content')
              </div>
            </div>
          </div>

          @if ($page->author)
            <div class="col-lg-4">
              <div class="ud-blog-sidebar">
                <div class="ud-articles-box">
                  <h3 class="ud-articles-box-title">Last Articles</h3>
                  <ul class="ud-articles-list">
                    @php $count = 0; @endphp
                    @foreach($posts as $article)
                      @php $count++; @endphp
                      @if($count >= 4)
                        @break
                      @endif
                      <li>
                        <div class="ud-article-image">
                          <a href="{{ $page->baseUrl }}team/{{ \Illuminate\Support\Str::slug($page->author) }}">
                            <img
                              src="https://www.gravatar.com/avatar/{{ $article->gravatar }}"
                              alt="{{ $article->author }}"
                            />
                          </a>
                        </div>
                        <div class="ud-article-content">
                          <h5 class="ud-article-title">
                            <a href="{{ $article->getUrl() }}">
                              {{ $article->title }}
                            </a>
                          </h5>
                          <a href="{{ $page->baseUrl }}team/{{ \Illuminate\Support\Str::slug($page->author) }}"> {{ $page->author }} </a>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </section>
    <!-- ====== Blog Details End ====== -->
@endsection