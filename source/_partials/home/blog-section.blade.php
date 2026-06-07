@php
  $limit      = $limit      ?? 3;
  $ctaHref    = $ctaHref    ?? locale_url($page, 'posts');
  $ctaLabel   = $ctaLabel   ?? $page->t('Access Our Full Blog');

  $sectionPosts = $page->mergeCollections($posts, $posts_wordpress)
    ->filter(fn($p) => current_path_locale($p) === current_path_locale($page))
    ->take($limit);

  $categoryMap = [
    'features' => 'Features',
    'security' => 'Security',
    'article'  => 'Article',
  ];
@endphp

<section class="ud-home-blog" data-aos="fade-up">
  <div class="container">
    @include('_partials.home.section-heading', [
      'title'    => $title,
      'subtitle' => $subtitle ?? null,
    ])

    <div class="row g-4 mt-4 justify-content-center align-items-stretch">
      @foreach ($sectionPosts as $post)
        @php
          $cats        = $post->categories ?? [];
          $rawCat      = is_array($cats) && !empty($cats) ? $cats[0] : ($post->category ?? 'article');
          $catKey      = is_string($rawCat) ? strtolower($rawCat) : 'article';
          $catLabel    = $categoryMap[$catKey]
            ?? \Illuminate\Support\Str::headline(str_replace(['-', '_'], ' ', $catKey));

          $authorAvatar = match(true) {
            ($post->author ?? null) === 'LibreSign'                               => $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png',
            !empty($post->gravatar ?? null) && str_starts_with($post->gravatar, '/') => $page->baseUrl . ltrim($post->gravatar, '/'),
            !empty($post->gravatar ?? null)                                        => 'https://www.gravatar.com/avatar/' . $post->gravatar . '?size=80',
            default                                                                => $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png',
          };
        @endphp

        <div class="col-lg-4 col-md-6 d-flex">
          <article class="ud-home-blog-card">
            <div class="ud-home-blog-card__media">
              <div class="ud-home-blog-card__frame">
                <img src="{{ $post->cover_image }}" alt="{{ $page->t($post->title) }}" />
              </div>
              <span class="ud-home-blog-card__category">{{ $page->t($catLabel) }}</span>
              <span class="ud-home-blog-card__badge" aria-hidden="true">
                <img src="{{ $authorAvatar }}" alt="" />
              </span>
            </div>
            <div class="ud-home-blog-card__content">
              <h4 class="ud-home-blog-card__title">{{ $page->t($post->title) }}</h4>
              <p class="ud-home-blog-card__excerpt">{{ $page->t($post->description) }}</p>
              <a href="{{ $post->getUrl() }}" class="ud-home-blog-card__link">{{ $page->t('Read more »') }}</a>
            </div>
          </article>
        </div>
      @endforeach
    </div>

    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <a href="{{ $ctaHref }}" class="ud-home-blog__cta">{{ $ctaLabel }}</a>
      </div>
    </div>
  </div>
</section>
