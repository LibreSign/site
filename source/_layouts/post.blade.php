@extends('_layouts.main')

@section('body') 

    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>Blog Page</h1>
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
          <div class="col-lg-12">
            <div class="ud-blog-details-image">
              <img
                src="{{ $page->banner }}"
                alt="blog details"
              />
              <div class="ud-blog-overlay">
                <div class="ud-blog-overlay-content">
                  <div class="ud-blog-author">
                    <img src="{{ $page->baseUrl }}assets/images/team/{{ \Illuminate\Support\Str::slug($page->author) }}.jpg" alt="author" />
                    <span>
                      By <a href="{{ $page->baseUrl }}team/{{ \Illuminate\Support\Str::slug($page->author) }}"> {{ $page->author }} </a>
                    </span>
                  </div>

                  <div class="ud-blog-meta">
                    <p class="date">
                      <i class="lni lni-calendar"></i> <span>{{ date('F j, Y', $page->date) }}</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="ud-blog-details-content">
              <h2 class="ud-blog-details-title">
                {{ $page->title }}
              </h2>
              
              @yield('content')

              <div class="ud-blog-details-action mt-5">
                {{-- <ul class="ud-blog-tags">
                  <li>
                    <a href="javascript:void(0)">Design</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Development</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Info</a>
                  </li>
                </ul> --}}
                <div class="ud-blog-share">
                  <h6>Share This Post</h6>
                  <ul class="ud-blog-share-links">
                    <li>
                      <a href="javascript:void(0)" class="facebook">
                        <i class="lni lni-facebook-filled"></i>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:void(0)" class="twitter">
                        <i class="lni lni-twitter-filled"></i>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:void(0)" class="linkedin">
                        <i class="lni lni-linkedin-original"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="ud-blog-sidebar">
              <div class="ud-newsletter-box">
                {{-- <img
                  src="{{ $page->baseUrl }}assets/images/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="{{ $page->baseUrl }}assets/images/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-2"
                /> --}}
                <h3 class="ud-newsletter-title">Join our newsletter!</h3>
                <p>Enter your email to receive our latest newsletter.</p>
                <form class="ud-newsletter-form">
                  <input
                    type="email"
                    name="email"
                    placeholder="Your Email address"
                  />
                  <button class="ud-main-btn">Subscribe Now</button>
                  <p class="ud-newsletter-note">Don't worry, we don't spam</p>
                </form>
              </div>

              <div class="ud-articles-box">
                <h3 class="ud-articles-box-title">Popular Articles</h3>
                <ul class="ud-articles-list">
                  @foreach($posts as $article)
                  <li>
                    <div class="ud-article-image">
                      <img
                        src="{{ $page->baseUrl }}assets/images/team/{{ \Illuminate\Support\Str::slug($article->author) }}.jpg"
                        alt="{{ $article->author }}"
                      />
                    </div>
                    <div class="ud-article-content">
                      <h5 class="ud-article-title">
                        <a href="javascript:void(0)">
                          {{ $article->title }}
                        </a>
                      </h5>
                      <p class="ud-article-author">{{ $article->author }}</p>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog Details End ====== -->

    <!-- ====== Blog Start ====== -->
    <section class="ud-blog-grids ud-related-articles">
      <div class="container">
        <div class="row col-lg-12">
          <div class="ud-related-title">
            <h2 class="ud-related-articles-title">Related Articles</h2>
          </div>
        </div>
        <div class="row">
          @foreach($posts as $post)
          <div class="col-lg-4 col-md-6">
            <div class="ud-single-blog">
              <div class="ud-blog-image">
                <a href="{{ $post->getUrl() }}">
                  <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" />
                </a>
              </div>
              <div class="ud-blog-content">
                <span class="ud-blog-date">{{ date('F j, Y', $post->date) }}</span>
                <h3 class="ud-blog-title">
                  <a href="blog-details.html">
                    {{ $post->title }}
                  </a>
                </h3>
                <p class="ud-blog-desc">
                  {{ $post->description }}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- ====== Blog End ====== -->
@endsection