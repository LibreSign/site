@php
  $categories    = is_array($post->categories ?? null) ? $post->categories : [];
  $firstCategory = !empty($categories) ? $categories[0] : 'article';
  $categoryKey   = is_string($firstCategory) ? strtolower($firstCategory) : 'article';
  $categoryMap   = ['features' => 'Features', 'security' => 'Security', 'article' => 'Article'];
  $categoryLabel = $categoryMap[$categoryKey]
    ?? \Illuminate\Support\Str::headline(str_replace(['-', '_'], ' ', $categoryKey));

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
    <span class="ud-home-blog-card__category">{{ $page->t($categoryLabel) }}</span>
    <span class="ud-home-blog-card__badge" aria-hidden="true">
      <img src="{{ $authorAvatar }}" alt="" />
    </span>
  </div>
  <div class="ud-home-blog-card__content">
    <h3 class="ud-home-blog-card__title">{{ $page->t($post->title) }}</h3>
    <p class="ud-home-blog-card__excerpt">{{ $page->t($post->description) }}</p>
    <a href="{{ $postUrl }}" class="ud-home-blog-card__link">{{ $page->t('Read more »') }}</a>
  </div>
</article>
