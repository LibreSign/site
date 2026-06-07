@php
  $iconSrc = !empty($post->card_icon ?? null) ? $page->baseUrl . $post->card_icon : null;
@endphp

<div class="ud-card">
  <div class="ud-card__header">
    <h5 class="ud-card__title">{{ $page->t($post->title) }}</h5>
  </div>

  @if ($iconSrc)
    <div class="ud-card__icon">
      <img src="{{ $iconSrc }}" alt="" />
    </div>
  @endif

  <div class="ud-card__body">
    <p>{{ $page->t($post->description ?? '') }}</p>
  </div>

  <div class="ud-card__actions">
    <a href="{{ $postUrl }}" class="btn ud-btn-outline-brand ud-card__link">
      {{ $page->t('Learn more') }}
    </a>
  </div>
</div>
