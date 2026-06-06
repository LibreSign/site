<section
  class="{{ $sectionClass ?? 'ud-hero' }}"
  @if (!empty($backgroundImage ?? null)) style="background-image: {{ $backgroundImage }};" @endif
>
  @if (!empty($imageSrc ?? null))
    <div class="ud-hero-image wow fadeInUp" data-aos-delay=".3s">
      <img src="{{ $imageSrc }}" alt="{{ $imageAlt }}" />
    </div>
  @endif
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="ud-hero-content wow fadeInUp" data-aos-delay=".2s">
          <h1 class="ud-hero-title">
            {{ $title }}
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
