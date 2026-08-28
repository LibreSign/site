@php
  $heroImage = $imageSrc ?? null;
  $heroGradient = $overlayGradient ?? null;
  $heroAlt = $imageAlt ?? null;

  $heroStyles = [];

  if (!empty($heroImage)) {
    $heroStyles[] = "--ud-hero-image: url('{$heroImage}')";
  }

  if (!empty($heroGradient)) {
    $heroStyles[] = "--ud-hero-gradient: {$heroGradient}";
  }

  $heroImageClass = !empty($heroAlt)
    ? 'ud-hero-image wow fadeInUp'
    : 'ud-hero-image ud-hero-image--bg';
@endphp

<section
  class="{{ $sectionClass ?? 'ud-hero' }}"
  @if ($heroStyles) style="{{ implode('; ', $heroStyles) }};" @endif
>
  @if (!empty($heroImage))
    <div class="{{ $heroImageClass }}" data-aos-delay=".3s">
      @if (!empty($heroAlt))
        <img src="{{ $heroImage }}" alt="{{ $heroAlt }}">
      @endif
    </div>
  @endif
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="ud-hero-content wow fadeInUp" data-aos-delay=".2s">
          <h1 class="ud-hero-title">
            @if (!empty($mobileTitle ?? null))
              <span class="ud-hero-title__desktop">{{ $title }}</span>
              <span class="ud-hero-title__mobile">{{ $mobileTitle }}</span>
            @else
              {{ $title }}
            @endif
          </h1>

          <p class="ud-hero-desc">
            {{ $description }}
          </p>

          <div class="row justify-content-between ud-hero-buttons g-4">
            @foreach ($actions as $action)
              <div class="col-sm-6 justify-content-center d-flex">
                <a href="{{ $action['href'] }}" class="{{ $action['class'] }}">
                  {{ $action['label'] }}
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
