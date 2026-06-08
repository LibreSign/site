@php
  $categories    = is_array($post->categories ?? null) ? $post->categories : [];
  $firstCategory = !empty($categories) ? $categories[0] : 'article';
  $categoryKey   = is_string($firstCategory) ? strtolower($firstCategory) : 'article';
  $categoryMap   = ['features' => 'Features', 'security' => 'Security', 'article' => 'Article'];
  $categoryLabel = $categoryMap[$categoryKey]
    ?? \Illuminate\Support\Str::headline(str_replace(['-', '_'], ' ', $categoryKey));

  $cardAuthorGravatars = [
    'Crisciany Silva' => 'f2f64ea713b5c39cb64268a0eda7e022',
    'Daiane Alves'    => 'fe9fbbf8677e78931af9a4a5da35e1ee',
    'Vitor Mattos'    => '35d3d1e49e1939461e2670a4d1fac6a3',
  ];
  $resolvedGravatar = ($post->gravatar ?? null) ?: ($cardAuthorGravatars[$post->author ?? ''] ?? null);

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
    <div class="ud-home-blog-card__frame">
      <img src="{{ $post->cover_image }}" alt="{{ $page->t($post->title) }}" />
    </div>
    <span class="ud-home-blog-card__category">{{ $page->t($categoryLabel) }}</span>
    <span class="ud-home-blog-card__badge" aria-hidden="true">
      <img src="{{ $authorAvatar }}" alt="{{ $post->author ?? '' }}" />
    </span>
  </div>
  <div class="ud-home-blog-card__content">
    <h3 class="ud-home-blog-card__title">{{ $page->t($post->title) }}</h3>
    <p class="ud-home-blog-card__excerpt">{{ $page->t($post->description) }}</p>
    <a href="{{ $postUrl }}" class="ud-home-blog-card__link">{{ $page->t('Read more »') }}</a>
  </div>
</article>
