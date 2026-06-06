<section class="{{ $sectionClass ?? 'ud-home-cta' }}" data-aos="fade-up">
  <div class="container">
    <div class="ud-home-cta__content wow fadeInUp" data-aos-delay=".2s">
      <h2 class="ud-home-cta__title">{{ $title }}</h2>

      @if (!empty($description))
        <p class="ud-home-cta__description">{{ $description }}</p>
      @endif

      @if (!empty($actions))
        <div class="ud-home-cta__actions">
          @foreach ($actions as $action)
            <a href="{{ $action['href'] }}" class="{{ $action['class'] }}">
              {{ $action['label'] }}
            </a>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
