@php
  $cats     = is_array($post->categories ?? null) ? $post->categories : [];
  $rawCat   = !empty($cats) ? $cats[0] : 'article';
  $catKey   = is_string($rawCat) ? strtolower($rawCat) : 'article';
  $catMap   = ['features' => 'Features', 'security' => 'Security', 'article' => 'Article'];
  $catLabel = $catMap[$catKey]
    ?? \Illuminate\Support\Str::headline(str_replace(['-', '_'], ' ', $catKey));

  $authorAvatar = match(true) {
    ($post->author ?? null) === 'LibreSign'                                            => $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png',
    !empty($post->gravatar ?? null) && str_starts_with($post->gravatar, '/')           => $page->baseUrl . ltrim($post->gravatar, '/'),
    !empty($post->gravatar ?? null)                                                    => 'https://www.gravatar.com/avatar/' . $post->gravatar . '?size=80',
    default                                                                            => $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png',
  };
@endphp

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
    <a href="{{ $postUrl }}" class="ud-home-blog-card__link">{{ $page->t('Read more »') }}</a>
  </div>
</article>
