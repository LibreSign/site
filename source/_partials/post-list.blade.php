{{--
  Generic post listing partial.

  Required:
    $format   — card template to use: 'blog' | 'feature' | 'grid'

  Optional data source (one of):
    $category — string: filters via getFromCategory() (locale-aware, sorted by date)
    (omit)    — all posts via mergeCollections(), filtered by current locale, sorted by date

  Optional display:
    $limit       — max number of posts to show (default: no limit)
    $sectionClass — CSS class for the <section> element
    $title       — section heading (omit to skip the heading entirely)
    $subtitle    — section subheading
    $cta         — ['href' => '...', 'label' => '...', 'class' => '...'] for bottom link
    $rowClass    — Bootstrap row classes (default: per format)
    $colClass    — Bootstrap column classes per card (default: per format)
--}}
@php
  $format = $format ?? 'blog';

  // Per-format layout defaults
  $formatDefaults = [
    'blog'    => ['col' => 'col-lg-4 col-md-6 d-flex', 'row' => 'row g-4 mt-4 justify-content-center align-items-stretch'],
    'feature' => ['col' => 'col-md-6 d-flex',          'row' => 'row text-center gy-5 align-items-stretch'],
    'grid'    => ['col' => 'col-lg-4 col-md-6',         'row' => 'row'],
  ];
  $colClass = $colClass ?? ($formatDefaults[$format]['col'] ?? 'col-lg-4 col-md-6 d-flex');
  $rowClass = $rowClass ?? ($formatDefaults[$format]['row'] ?? 'row g-4');

  // Data fetching
  if (isset($category)) {
    // getFromCategory: already locale-filtered, date-sorted, returns stdClass[]
    $postItems = collect($page->getFromCategory($category));
  } else {
    // mergeCollections: needs locale filter; already date-sorted
    $postItems = $page->mergeCollections($posts, $posts_wordpress)
      ->filter(fn($p) => current_path_locale($p) === current_path_locale($page));
  }

  if (!empty($limit ?? null)) {
    $postItems = $postItems->take($limit);
  }

  $cardTemplate = '_partials.card-layouts.' . $format;
@endphp

<section class="{{ $sectionClass ?? 'ud-home-blog' }}"
  @if(!empty($sectionId ?? '')) id="{{ $sectionId }}"@endif
  data-aos="fade-up">
  <div class="container">

    @if (!empty($title ?? null))
      @include('_partials.home.section-heading', [
        'title'    => $title,
        'subtitle' => $subtitle ?? null,
      ])
    @endif

    <div class="{{ $rowClass }}">
      @foreach ($postItems as $post)
        @php
          $postUrl = method_exists($post, 'getUrl') ? $post->getUrl() : ($post->url ?? '#');
        @endphp
        <div class="{{ $colClass }}">
          @include($cardTemplate, ['post' => $post, 'postUrl' => $postUrl, 'cardModifier' => $cardModifier ?? null])
        </div>
      @endforeach
    </div>

    @if (!empty($cta ?? null))
      <div class="row">
        <div class="col-12 d-flex justify-content-center">
          <a href="{{ $cta['href'] }}" class="{{ $cta['class'] ?? 'ud-home-blog__cta' }}">
            {{ $cta['label'] }}
          </a>
        </div>
      </div>
    @endif

  </div>
</section>
