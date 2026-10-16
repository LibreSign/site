@php
  $heroImage = $imageSrc ?? null;
  $heroGradient = $overlayGradient ?? null;
  $heroAlt = $imageAlt ?? null;
  $heroSrcset = $imageSrcset ?? null;
  $heroSizes = $imageSizes ?? '(min-width: 1921px) 1920px, 100vw';
  $heroPositionMobile = $imagePositionMobile ?? null;

  $heroStyles = [];

  if (!empty($heroImage)) {
    $heroStyles[] = "--ud-hero-image: url('{$heroImage}')";
  }

  if (!empty($heroPositionMobile)) {
    $heroStyles[] = "--ud-hero-image-position-mobile: {$heroPositionMobile}";
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
        <img
          src="{{ $heroImage }}"
          @if (!empty($heroSrcset)) srcset="{{ $heroSrcset }}" sizes="{{ $heroSizes }}" @endif
          alt="{{ $heroAlt }}"
        >
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
