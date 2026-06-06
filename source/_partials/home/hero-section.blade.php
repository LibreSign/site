<section class="{{ $sectionClass ?? 'ud-hero' }}">
  @if (!empty($imageSrc ?? null))
    <div class="{{ $imageWrapperClass ?? 'ud-hero-image wow fadeInUp' }}" data-aos-delay=".3s">
      <img src="{{ $imageSrc }}" alt="{{ $imageAlt }}" />
    </div>
  @endif
  <div class="container">
    <div class="{{ $rowClass ?? 'row' }}">
      <div class="{{ $contentColumnClass ?? 'col-lg-6' }}">
        <div class="{{ $contentWrapperClass ?? 'ud-hero-content wow fadeInUp' }}" data-aos-delay=".2s">
          @if (!empty($eyebrow))
            <span class="ud-hero-eyebrow">{{ $eyebrow }}</span>
          @endif

          <h1 class="{{ $titleClass ?? 'ud-hero-title' }}">
            {{ $title }}
          </h1>

          <p class="{{ $descriptionClass ?? 'ud-hero-desc' }}">
            {{ $description }}
          </p>

          <div class="{{ $buttonsClass ?? 'row justify-content-between ud-hero-buttons g-4' }}">
            @foreach ($actions as $action)
              <div class="{{ $action['colClass'] ?? 'col-sm-6 justify-content-center d-flex' }}">
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
