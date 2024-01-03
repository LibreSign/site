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
                <ul class="ud-blog-tags">
                  <li>
                    <a href="javascript:void(0)">Design</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Development</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Info</a>
                  </li>
                </ul>
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
                <img
                  src="assets/images/blog/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="assets/images/blog/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-2"
                />
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
                  <li>
                    <div class="ud-article-image">
                      <img
                        src="assets/images/blog/article-author-01.png"
                        alt="author"
                      />
                    </div>
                    <div class="ud-article-content">
                      <h5 class="ud-article-title">
                        <a href="javascript:void(0)">
                          The 8 best landing page builders, reviewed
                        </a>
                      </h5>
                      <p class="ud-article-author">Martin Fedous</p>
                    </div>
                  </li>
                  <li>
                    <div class="ud-article-image">
                      <img
                        src="assets/images/blog/article-author-02.png"
                        alt="author"
                      />
                    </div>
                    <div class="ud-article-content">
                      <h5 class="ud-article-title">
                        <a href="javascript:void(0)">
                          Create engaging online courses your student…
                        </a>
                      </h5>
                      <p class="ud-article-author">Glomiya Lucy</p>
                    </div>
                  </li>
                  <li>
                    <div class="ud-article-image">
                      <img
                        src="assets/images/blog/article-author-03.png"
                        alt="author"
                      />
                    </div>
                    <div class="ud-article-content">
                      <h5 class="ud-article-title">
                        <a href="javascript:void(0)">
                          The ultimate formula for launching online course
                        </a>
                      </h5>
                      <p class="ud-article-author">Andrio jeson</p>
                    </div>
                  </li>
                  <li>
                    <div class="ud-article-image">
                      <img
                        src="assets/images/blog/article-author-04.png"
                        alt="author"
                      />
                    </div>
                    <div class="ud-article-content">
                      <h5 class="ud-article-title">
                        <a href="javascript:void(0)">
                          50 Best web design tips & tricks that will help you
                        </a>
                      </h5>
                      <p class="ud-article-author">Samoyel Dayno</p>
                    </div>
                  </li>
                </ul>
              </div>

              <div class="ud-banner-ad">
                <a href="javascript:void(0)">
                  <img
                    src="assets/images/blog/bannder-ad.png"
                    alt="ad banner"
                  />
                </a>
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
          <div class="col-lg-4 col-md-6">
            <div class="ud-single-blog">
              <div class="ud-blog-image">
                <a href="blog-details.html">
                  <img src="assets/images/blog/blog-01.jpg" alt="blog" />
                </a>
              </div>
              <div class="ud-blog-content">
                <span class="ud-blog-date">Dec 22, 2023</span>
                <h3 class="ud-blog-title">
                  <a href="blog-details.html">
                    Meet AutoManage, the best AI management tools
                  </a>
                </h3>
                <p class="ud-blog-desc">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="ud-single-blog">
              <div class="ud-blog-image">
                <a href="blog-details.html">
                  <img src="assets/images/blog/blog-02.jpg" alt="blog" />
                </a>
              </div>
              <div class="ud-blog-content">
                <span class="ud-blog-date">Dec 22, 2023</span>
                <h3 class="ud-blog-title">
                  <a href="blog-details.html">
                    How to earn more money as a wellness coach
                  </a>
                </h3>
                <p class="ud-blog-desc">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="ud-single-blog">
              <div class="ud-blog-image">
                <a href="blog-details.html">
                  <img src="assets/images/blog/blog-03.jpg" alt="blog" />
                </a>
              </div>
              <div class="ud-blog-content">
                <span class="ud-blog-date">Dec 22, 2023</span>
                <h3 class="ud-blog-title">
                  <a href="blog-details.html">
                    The no-fuss guide to upselling and cross selling
                  </a>
                </h3>
                <p class="ud-blog-desc">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog End ====== -->
@endsection