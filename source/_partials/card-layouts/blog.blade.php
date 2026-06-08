@php
  $categories    = is_array($post->categories ?? null) ? $post->categories : [];
  $firstCategory = !empty($categories) ? $categories[0] : 'article';
  $categoryKey   = is_string($firstCategory) ? strtolower($firstCategory) : 'article';
  $categoryMap   = ['features' => 'Features', 'security' => 'Security', 'article' => 'Article'];
  $categoryLabel = $categoryMap[$categoryKey]
    ?? \Illuminate\Support\Str::headline(str_replace(['-', '_'], ' ', $categoryKey));

  $resolvedGravatar = ($post->gravatar ?? null) ?: ($page->authorGravatars[$post->author ?? ''] ?? null);

  $authorAvatar = match(true) {
    ($post->author ?? null) === 'LibreSign'
       => $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png',
    !empty($resolvedGravatar) && str_starts_with($resolvedGravatar, '/')
       => $page->baseUrl . ltrim($resolvedGravatar, '/'),
    !empty($resolvedGravatar)
       => 'https://www.gravatar.com/avatar/' . $resolvedGravatar . '?size=80',
    default
       => $page->baseUrl . 'assets/images/logo/Avatar-LibreSign.png',
  };
@endphp

<article class="ud-home-blog-card">
  <div class="ud-home-blog-card__media">
    <a href="{{ $postUrl }}" class="ud-home-blog-card__frame" tabindex="-1" aria-hidden="true">
      <img src="{{ $post->cover_image }}" alt="{{ $page->t($post->title) }}" />
    </a>
    <a href="{{ locale_url($page, 'category/' . $categoryKey) }}" class="ud-home-blog-card__category">{{ $page->t($categoryLabel) }}</a>
    <span class="ud-home-blog-card__badge" aria-hidden="true">
      <img src="{{ $authorAvatar }}" alt="{{ $post->author ?? '' }}" />
    </span>
  </div>
  <div class="ud-home-blog-card__content">
    <h3 class="ud-home-blog-card__title">
      <a href="{{ $postUrl }}" class="ud-home-blog-card__title-link">{{ $page->t($post->title) }}</a>
    </h3>
    <p class="ud-home-blog-card__excerpt">{{ $page->t($post->description) }}</p>
    <a href="{{ $postUrl }}" class="ud-home-blog-card__link">{{ $page->t('Read more »') }}</a>
  </div>
</article>
